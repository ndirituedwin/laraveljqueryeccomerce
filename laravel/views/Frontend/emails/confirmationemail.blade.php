<!DOCTYPE html>
 <html>
     <head>
         <title></title>
     </head>
     <body>
         <table>
             <tr>
                 <td>Dear {{$name}}</td>
             </tr>
             <tr>
                 <td> please click on the link below to activate your acccount</td>
             </tr>
             <tr>
                 <td>&nbsp;</td>
             </tr>
             <tr>
                 <td><a href="{{ route('acount.activation', $code) }}">Confirm Account</a></td>
             </tr>
             <tr>
                <td>&nbsp;</td>  
             </tr>
             <tr>
                 Thanks and regards from eccomerce
             </tr>
            
         </table>
     </body>
 </html>