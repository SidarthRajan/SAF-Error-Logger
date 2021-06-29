function readLog(){
    // let files = document.getElementByID('myFile').files;
    // let file = files[0];
    // const fs = require('fs')
    // fs.readFile(file, (err, data) => {
    //     if (err) throw err;
    //     let viewedData = data.toString();
    //     getStr(viewedData);
    //
    //     console.log(getStr(viewedData));
    //
    // })
    document.getElementById('myFile')
        .addEventListener('change', function() {

            let fr=new FileReader();
            // let viewedData = fr.result;
            // getStr(viewedData);
            fr.onload=function(){
                document.getElementById('output')
                    .textContent=fr.result.toString();
            }

            fr.readAsText(this.files[0]);
        })
}

// function getStr(viewedData) {
//     // return viewedData.split('').map(item => item).join('')
//     let error_date = viewedData.substring(0, 9);
//     const logs = viewedData.split(error_date);
//     const retData = [];
//     // return splitData[0];
//     // return viewedData.split(' : ');
//     // return splitData.length;
//     for (let i = 0; i < logs.length; i++) {
//         // if ((i % 2 == 1) || (i == 1)) {
//         //     const splitError = splitData[i].split(':');
//         //     let preRetlet = splitError[4] + "ERROR IS DONE";
//         //     //let postRetlet = splitError[5] + "ERROR IS DONE";
//         //     // let retlet = splitData[i] + " ERROR IS DONE ";
//         //     retData[i] = preRetlet;
//         //     retData[i+1] = postRetlet
//         // }
//         const splitIndivError = logs[i].split('|');
//         let error_time = splitIndivError[0];
//         let error_type = splitIndivError[5];
//         const splitForFile = splitIndivError[6].split('at');
//         let error_spec = splitForFile[0];
//         let error_file = splitForFile[1].split(':line ')[0];
//         let error_line = splitForFile[1].split(':line ')[1];
//         let error_trace = null;
//         let temp_trace = null;
//         if (splitIndivError.length > 7) {
//             for (let j = 8; j < splitIndivError.length; j++) {
//                 temp_trace += splitIndivError[j];
//             }
//             error_trace = temp_trace
//         }
//         $.ajax({
//             type: "POST",
//             url: 'addError.php',
//             data: "Date:" + error_date + "Time:" + error_time + "Type:" + error_type + "Spec:" + error_spec + "File:" + error_file +  "Line:" + error_line +  "Trace:" + error_trace,
//             success: function(data)
//             {
//                 alert("sucess!");
//             }
//         });
//         // for (let j = 8; j < splitIndivError.length; j++) {
//         //     splitIndivError[8]
//         // }
//         // let error_trace = null;
//         // const date;
//         // const time;
//         // const error_type;
//         // const error_spec;
//         // const error_file;
//         // const error_line;
//         // const error_trace;
//         // const splitError = splitData[i].split(':');
//         // let retlet = splitError[4] + " SPACE " + splitError[5];
//         // retData[i] = retlet
//     }
//     //return retData;
// }
debugger
function getStr(viewedData) {
    let error_date = viewedData.substring(0, 9);
    const logs = viewedData.split(error_date);
    const retData = [];
    for (let i = 0; i < logs.length; i++) {
        const splitIndivError = logs[i].split('|');
        let error_time = splitIndivError[0];
        let error_type = splitIndivError[5];
        const splitForFile = splitIndivError[6].split('at');
        let error_spec = splitForFile[0];
        let error_file = splitForFile[1].split(':line ')[0];
        let error_line = splitForFile[1].split(':line ')[1];
        let error_trace = null;
        let temp_trace = null;
        if (splitIndivError.length > 7) {
            for (let j = 8; j < splitIndivError.length; j++) {
                temp_trace += splitIndivError[j];
            }
            error_trace = temp_trace
        }
        $.ajax({
            type: "POST",
            url: 'addError.php',
            data: "Date:" + error_date + "Time:" + error_time + "Type:" + error_type + "Spec:" + error_spec + "File:" + error_file +  "Line:" + error_line +  "Trace:" + error_trace,
            success: function(data)
            {
                alert("sucess!");
            }
        });
    }
}