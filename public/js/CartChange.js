/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function process(x, sign, id) {
                value = parseInt(document.getElementById(('amount' + x + id)).innerHTML);
                tong = parseFloat(document.getElementById("tong").innerHTML);
                document.getElementById('amount' + x + id).innerHTML = (value + (sign ? 1 : -1));
                price = parseFloat(document.getElementById("gia" + x).innerHTML);
                document.getElementById("tong").innerHTML = tong + (sign ? 1 : -1) * price;
}                                                                                                                                                                                                    