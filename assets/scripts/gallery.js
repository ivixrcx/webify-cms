
let __ff = []
let __nn = 0
let __pv = 0

let base_url = location.origin + '/webify/'
// let base_url = location.origin + '/'

// ************************ Drag and drop ***************** //
let dropArea = document.getElementById("drop-area")

// Prevent default drag behaviors
;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, preventDefaults, false)
  document.body.addEventListener(eventName, preventDefaults, false)
})

// Highlight drop area when item is dragged over it
;['dragenter', 'dragover'].forEach(eventName => {
  dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
  dropArea.addEventListener(eventName, unhighlight, false)
})

// Handle dropped files
dropArea.addEventListener('drop', handleDrop, false)

function preventDefaults (e) {
  e.preventDefault()
  e.stopPropagation()
}

function highlight(e) {
  dropArea.classList.add('highlight')
}

function unhighlight(e) {
  dropArea.classList.remove('active')
}

function handleDrop(e) {
  var dt = e.dataTransfer
  var files = dt.files

  handleFiles(files)
}

let uploadProgress = []
let progressBar = document.getElementById('progress-bar')

function initializeProgress(numFiles) {
  progressBar.value = 0
  uploadProgress = []

  for(let i = numFiles; i > 0; i--) {
    uploadProgress.push(0)
  }
}

function updateProgress(fileNumber, percent) {
  uploadProgress[fileNumber] = percent
  let total = uploadProgress.reduce((tot, curr) => tot + curr, 0) / uploadProgress.length
  console.debug('update', fileNumber, percent, total)
  progressBar.value = total
}

function handleFiles(files) {
  // re-initialize storage vars
  __ff = []
  __nn = 0
  __pv = 0

  files = [...files]
  for (let i = 0; i < files.length; i++) {
    // push random number as filename for upload
    let ext = files[i].name.split('.').reverse()[0]
    __ff[i] = 'photo-' + Math.random().toString(9).substring(2,7) + '.' + ext;
  }

  initializeProgress(files.length)
  files.forEach(uploadFile)
  files.forEach(previewFile)
}

function previewFile(file) {
  let reader = new FileReader()
  reader.readAsDataURL(file)
  reader.onloadend = function(a,b,c) {
    let div = document.createElement('div')
    div.id = __ff[__pv]
    div.style = 'width: 200px; margin: 5px;'
    div.className = 'thumbnail pull-left'

    let span = document.createElement('span')
    span.style = 'position: absolute'
    span.className = 'close'
    span.innerHTML = '&times'
    span.onclick = function(e){
      // delete from viewport
      let foldername = document.getElementById('gallery_dir').value
      let photoId = e.target.parentNode.id
      document.getElementById(photoId).remove();

      let url = base_url + 'delete_photo/' + foldername + '/' + photoId
      let xhr = new XMLHttpRequest()
      xhr.open('POST', url, true)
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
      xhr.addEventListener('readystatechange', function(e) {
        if (xhr.readyState == 4 && xhr.status == 200) {
          console.log(xhr.response)
        }
        else if (xhr.readyState == 4 && xhr.status != 200) {
          // Error. Inform the user
          console.log('error')
          console.log(xhr.response)
        }
      })
      xhr.send()
    }

    let img = document.createElement('img')
    img.src = reader.result
    img.style = 'width: 100%'
    img.className = 'img-responsive'

    div.append(span)
    div.append(img)

    document.getElementById('gallery').appendChild(div)
    __pv++
  }
}

function uploadFile(file, i) {
  let foldername = document.getElementById('gallery_dir').value
  let url = location.origin + '/webify/upload_gallery/' + foldername + '/' + __ff[__nn].split('.').reverse().pop()
  // let url = location.origin + '/upload_gallery/' + foldername + '/' + __ff[__nn].split('.').reverse().pop()
  let xhr = new XMLHttpRequest()
  let formData = new FormData()
  xhr.open('POST', url, true)
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')

  // Update progress (can be used to show progress indicator)
  xhr.upload.addEventListener("progress", function(e) {
    updateProgress(i, (e.loaded * 100.0 / e.total) || 100)
  })

  xhr.addEventListener('readystatechange', function(e) {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // console.log(xhr.response)

      updateProgress(i, 100) // <- Add this
    }
    else if (xhr.readyState == 4 && xhr.status != 200) {
      // Error. Inform the user
    }
  })

  formData.append('userfile', file)
  xhr.send(formData)
  __nn++
}
