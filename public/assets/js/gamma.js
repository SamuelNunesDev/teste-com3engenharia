$(function() {
    var GammaSettings = {
            viewport : [ {
                width : 1200,
                columns : 5
            }, {
                width : 900,
                columns : 4
            }, {
                width : 500,
                columns : 3
            }, { 
                width : 320,
                columns : 2
            }, { 
                width : 0,
                columns : 2
            } ]
    };
    Gamma.init(GammaSettings);

    let dropArea = document.getElementById('drop-area')

    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
    })
      
    function preventDefaults (e) {
        e.preventDefault()
        e.stopPropagation()
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false)
    })
    
    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false)
    })
    
    function highlight(e) {
        dropArea.classList.add('highlight')
    }
    
    function unhighlight(e) {
        dropArea.classList.remove('highlight')
    }
      
    dropArea.addEventListener('drop', handleDrop, false)

    function handleDrop(e) {
        let dt = e.dataTransfer
        let files = dt.files

        handleFiles(files)
    }
});