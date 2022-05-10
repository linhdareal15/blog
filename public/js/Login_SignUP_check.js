/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var check = function () {
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    if (document.getElementsByName("pass1").value=== document.getElementsByName("pass2").value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById("message").innerHTML = 'matching';
        console.log("ok")
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
        console.log("notok")
    }
}