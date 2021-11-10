jQuery(document).ready(function(){
   $.ajaxSetup({
     headers:{
       'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
   });
   jQuery("#sortt").on('change',function(){
            this.form.submit();
   });
   jQuery(".addressdelete").on('click',function(){
     var result=confirm("Are you sure you wanna delete this address?")
     if(!result){
       return false;
     }
   });
   jQuery("#currentpassword").keyup(function(){
    var currentpassword=jQuery("#currentpassword").val();
   // alert(password);
    jQuery.ajax({
        type:'post',
        url:'/front/currentpass',
        data:{currentpassword:currentpassword},
        success:function(resp){
           //alert(resp);
            if(resp==false){
                jQuery("#currentpass").html("<font color=red>Current password is in correct</>");
            }else if(resp==true){
                jQuery("#currentpass").html("<font color=green>password is correct</>");
            }
        },
        error:function(){
            alert("error");
        }
    });
}); 
jQuery("#confirmpassword").keyup(function(){
    var confirmpassword=jQuery("#confirmpassword").val();
    var password=jQuery("#newpassword").val();
  //  alert(password);
   // alert(confirmpassword);
    jQuery.ajax({
        type:'post',
        url:'/front/confirmpassword',
        data:{password:password,confirmpassword:confirmpassword},
        success:function(resp){
             // alert(resp);
              if(resp==false){
                jQuery("#confirmpass").html("<font color=red> password confirmation does not match with new password</>");
            }else if(resp==true){
                jQuery("#confirmpass").html("<font color=green>passwords now match</>");
            }
        },
        error:function(){
            alert("error");
        }

    });
})
   //phone number validation
   jQuery("#mobilenumber").keyup(function(){
    var phone=jQuery("#mobilenumber").val();
  // alert(email);

    jQuery.ajax({
        type:'post',
        url:'/frontend/checkphonenumber',
        data:{phone:phone},
        success:function(resp){
        //alert(resp);
            if(resp==false){
                jQuery("#checkphonenumber").html("<font color=red>Phone number has already been taken</>");
            }else if(resp==true){
                jQuery("#checkphonenumber").html("<font color=green>phone number is correct</>");
            }
        },
      /*  error:function(){
            alert("error");
        }*/
    });
});

   //validate em ail
   jQuery("#emailvalidate").keyup(function(){
    var email=jQuery("#emailvalidate").val();
  // alert(email);
    jQuery.ajax({
        type:'post',
        url:'/frontend/checkemail',
        data:{email:email},
        success:function(resp){
       //    alert(resp);
            if(resp==false){
                jQuery("#checkcurrentemail").html("<font color=red>email already exists</>");
            }else if(resp==true){
                jQuery("#checkcurrentemail").html("<font color=green>email passed</>");
            }
        },
        error:function(){
            alert("error");
        }
    });
});
//password
   jQuery("#passwordone").keyup(function(){
    var password=jQuery("#passwordone").val();
    var email=jQuery("#emailone").val();
  // alert(password);
    jQuery.ajax({
        type:'post',
        url:'/frontend/checkcurrentpassword',
        data:{password:password,email:email},
        success:function(resp){
        //   alert(resp);
            if(resp==false){
                jQuery("#checkcurrentpassword").html("<font color=red>Current password is incorrect</>");
            }else if(resp==true){
                jQuery("#checkcurrentpassword").html("<font color=green>password is correct</>");
            }
        },
        error:function(){
            alert("error");
        }
    });
});
jQuery("#emailone").keyup(function(){
  var email=jQuery("#emailone").val();
 //alert(password);
  jQuery.ajax({
      type:'post',
      url:'/frontend/checkemailclient',
      data:{email:email},
      success:function(resp){
      //  alert(resp);
          if(resp==false){
              jQuery("#checkcurrentemail").html("<font color=red>Email fails to match with our records</>");
          }else if(resp==true){
              jQuery("#checkcurrentemail").html("<font color=green>email is now correct</>");
          }
      },
      error:function(){
          alert("error");
      }
  });
});
jQuery("#password_confirmation").keyup(function(){
    var password_confirmation=jQuery("#password_confirmation").val();
    var password=jQuery("#password").val();
  //alert(password);
  // alert(password_confirmation);
    jQuery.ajax({
        type:'post',
        url:'/frontend/confirmationofpasswords',
        data:{password:password,password_confirmation:password_confirmation},
        success:function(resp){
             // alert(resp);
              if(resp==false){
                jQuery("#checkconfirmpassword").html("<font color=red> password confirmation does not match with new password</>");
            }else if(resp==true){
                jQuery("#checkconfirmpassword").html("<font color=green>passwords now match</>");
            }

        },
        error:function(){
            alert("error");
        }

    });
});

    jQuery("#sort").on('change',function(){
  //this.form.submit();
  var sort=jQuery(this).val();
  var fabric=get_filter("fabric");
  var sleeve=get_filter("sleeve");
  var pattern=get_filter("pattern");
  var fit=get_filter("fit");
  var occassion=get_filter("occassion");
  var slug=jQuery("#slug").val();

            jQuery.ajax({
              url:'/categoryproducts/'+slug,
              method:"post",
              data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort:sort,slug:slug},
              success:function(data){
                // console.log(data);
                 jQuery(".filteproducts").html(data);
              },

              error:function(){
              alert("error");
              }


            })
    });
    //fabric
    jQuery(".fabric").on('click',function(){
      var fabric=get_filter("fabric");
  var sleeve=get_filter("sleeve");
  var pattern=get_filter("pattern");
  var fit=get_filter("fit");
  var occassion=get_filter("occassion");

      var sort=jQuery("#sort option:selected").val();
      var slug=jQuery("#slug").val();
      jQuery.ajax({
        url:'/categoryproducts/'+slug,
        method:"post",
        data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort:sort,slug:slug},
        success:function(data){
          // console.log(data);
           jQuery(".filteproducts").html(data);
        },
        error:function(){
          alert("error");
        }


      })
    });
    //sleeve
    jQuery(".sleeve").on('click',function(){
      var fabric=get_filter("fabric");
      var sleeve=get_filter("sleeve");
      var pattern=get_filter("pattern");
      var fit=get_filter("fit");
      var occassion=get_filter("occassion");

      var sort=jQuery("#sort option:selected").val();
      var slug=jQuery("#slug").val();
      jQuery.ajax({
        url:'/categoryproducts/'+slug,
        method:"post",
        data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort:sort,slug:slug},
        success:function(data){
          // console.log(data);
           jQuery(".filteproducts").html(data);
        },
        error:function(){
          alert("error");
        }


      })
    });
    //pattern
        jQuery(".pattern").on('click',function(){
          var fabric=get_filter("fabric");
          var sleeve=get_filter("sleeve");
          var pattern=get_filter("pattern");
          var fit=get_filter("fit");
          var occassion=get_filter("occassion");

      var sort=jQuery("#sort option:selected").val();
      var slug=jQuery("#slug").val();
      jQuery.ajax({
        url:'/categoryproducts/'+slug,
        method:"post",
        data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort:sort,slug:slug},
        success:function(data){
          // console.log(data);
           jQuery(".filteproducts").html(data);
        },
        error:function(){
          alert("error");
        }


      })
    });

      //pattern
      jQuery(".fit").on('click',function(){
        var fabric=get_filter("fabric");
        var sleeve=get_filter("sleeve");
        var pattern=get_filter("pattern");
        var fit=get_filter("fit");
        var occassion=get_filter("occassion");

    var sort=jQuery("#sort option:selected").val();
    var slug=jQuery("#slug").val();
    jQuery.ajax({
      url:'/categoryproducts/'+slug,
      method:"post",
      data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort:sort,slug:slug},
      success:function(data){
        // console.log(data);
         jQuery(".filteproducts").html(data);
      },
      error:function(){
        alert("error");
      }


    })
  });

    //pattern
    jQuery(".occassion").on('click',function(){
      var fabric=get_filter("fabric");
      var sleeve=get_filter("sleeve");
      var pattern=get_filter("pattern");
      var fit=get_filter("fit");
      var occassion=get_filter("occassion");

  var sort=jQuery("#sort option:selected").val();
  var slug=jQuery("#slug").val();
  jQuery.ajax({
    url:'/categoryproducts/'+slug,
    method:"post",
    data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occassion:occassion,sort:sort,slug:slug},
    success:function(data){
      // console.log(data);
       jQuery(".filteproducts").html(data);
    },
    error:function(){
      alert("error");
    }


  })
});
    function get_filter(class_name){
      var filter= [];
      $('.'+class_name+':checked').each(function(){
        filter.push($(this).val());
      });
      return filter;
    }
    $("#getsize").change(function(){
      var size=$(this).val();
       if(size==""){
        alert("please select size");
        return false;
      }
      var product_id=$(this).attr("product_id");
      var slug=$(this).attr("slug");

      $.ajax({
        url:'/get-product-size',
        data:{size:size,product_id:product_id},
        type:'post',
        success:function(resp){
        //  alert(resp['productprice']);
         // alert(resp['discounted_price']);
          if(resp['discount']>0){
            jQuery(".getattributeprice").html("<del>Ksh/="+resp['productprice']+"</del> Disc price:Kshs/="+resp['discounted_price']);
          }else{
           jQuery(".getattributeprice").html("Ksh/="+resp['productprice']);

          }
         // alert(rep);
        },
        error:function(){
          alert("error");
        }
      });
    });
    //update cart item
    $(document).on('click','.btnItemUpdate',function(){
     if($(this).hasClass('qtyMinus')){
       //var quantity=jQuery(this).prev().val();
       var quantity=jQuery("#appendedInputButtons").val();
       //alert(quantity);
      if(quantity<=1){
        Swal.fire({
          title: 'Warning',
          text: "You cannot reduce the quantity any further",
          icon: 'warning',
          // showCancelButton: true,
          // confirmButtonColor: '#3085d6',
          // cancelButtonColor: '#d33',
          // confirmButtonText: 'Yes, delete it!'
        });
        return false;
      }else{
             new_qty=parseInt(quantity)-1;
           //  alert(new_qty);
      }
     }
     if($(this).hasClass('qtyPlus')){
      var quantity=jQuery("#appendedInputButtons").val();

//      var quantity=jQuery(this).prev().prev().val();
       new_qty=parseInt(quantity)+1;
      // alert(new_qty);
     }
     //alert(new_qty);
     var cartid=$(this).data('cartid');
    // alert(cartid);
    jQuery.ajax({
          data:{"cartid":cartid,"qty":new_qty},
         url:'/updatecartquantitywithajax',
         type:'post',
         success:function(resp){
          //alert(resp.status);
          if(resp.status==false){
//            alert(resp.message);

          }
          //alert(resp.TotalCartItems);
          jQuery("#appendcartitems").html(resp.view);
          // jQuery("#appedninpu").html(resp.view);
          $(".ttcartitems").html(resp.TotalCartItems);
        //  jQuery("#appendcartitems").html(resp.view);
         },
         error:function(){
           alert("error");
         }
    });


    });




      //delete cart item
      jQuery(document).on('click','.btnItemDelete',function(){
        var cartid=jQuery(this).data('cartid');
        // var record=jQuery(this).attr("record");
        // var recordid=jQuery(this).attr("recordid");
        // Swal.fire({
        //   title: 'Are you sure?',
        //   text: "You won't be able to revert this!",
        //   icon: 'warning',
        //   showCancelButton: true,
        //   confirmButtonColor: '#3085d6',
        //   cancelButtonColor: '#d33',
        //   confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        //   if (result.isConfirmed) {
        //     Swal.fire(
        //       'Deleted!',
        //       'Your file has been deleted.',
        //       'success'
        //     )
        //     window.location.href="/frontend/delete-"+record+"/"+recordid;
        //     $(".ttcartitems").html(resp.TotalCartItems);
        //                  jQuery("#appendcartitems").html(resp.view);
        //   }
        // });
       var result=confirm("Are you sure you wanna trash this item ?");
       if(result){
        jQuery.ajax({
            type:'post',
            url:'/deletecartitemwithajax/easily',
            data:{"cartid":cartid},
            success:function(resp){

              $(".ttcartitems").html(resp.TotalCartItems);
                  jQuery("#appendcartitems").html(resp.view);

            },
          //  error:function(resp){
          //       console.log(resp);
          //     alert(resp);
          //   }
       });
       }
       });
       //apply coupon
       jQuery("#applycoupon").submit(function(){
     var user=jQuery(this).attr("user");
     if(user==1){
       //do noting
     }else{
       alert("login to apply coupon");
       return false;
     }
     var couponcode=jQuery("#couponcode").val();
    // alert(couponcode);
     jQuery.ajax({
       type:'post',
       url:'/cart/couponcodeapply',
       data:{couponcode:couponcode},
       success:function(resp){
      //  alert( resp.couponamount);
        if(resp.message!=""){
          alert(resp.message);
        }
        $(".ttcartitems").html(resp.TotalCartItems);
        jQuery("#appendcartitems").html(resp.view);
        if(resp.couponamount >=0){
          jQuery(".couponamount").text("Kshs."+resp.couponamount);
        }else{
          jQuery(".couponamount").text("Kshs.0");
        }
       // jQuery(".grand_total").html(resp.grand_total);
        //alert(resp.grand_total);
        if(resp.grand_total>=0){
         // alert(resp.grand_total);
         // return false;
         jQuery(".grand_total").text("Kshs "+resp.grand_total);
        }

       },
       error:function(){
         alert("error");
       }
     });

       });
       jQuery("input[name=address_id]").bind('change',function(){
        //alert("mn");
        var shippingcharges=jQuery(this).attr("shipping_charges");
        var totalprice=jQuery(this).attr("total_price");
        var couponamount=jQuery(this).attr("coupon_amount");
        var codpincodecount=jQuery(this).attr("codpincodecount");
        var prepaidpincodecount=jQuery(this).attr("prepaidpincodecount");

        if(codpincodecount>0){
          jQuery(".codmethod").show();
        }else{
          jQuery(".codmethod").hide();


        }
        if(prepaidpincodecount>0){
          jQuery(".prepaidmethod").show();
          //jQuery(".placeordr").show();

    }else{
      //hide cod button
      jQuery(".prepaidmethod").hide();
      //jQuery(".placeordr").hide();
    }

       // alert(couponamount);
        if(couponamount==""){
           couponamount=0;

        }
        jQuery(".shipping_charges").html("Kshs."+shippingcharges);
        var grand_total=parseInt(totalprice)+parseInt(shippingcharges)-parseInt(couponamount);
        //alert(grand_total);
        jQuery(".couponamount").html("Kshs."+couponamount);
        jQuery(".grand_total").html("Kshs."+grand_total);
    });

    //checkingthe pincode
    jQuery("#checkpincode").on('click',function(){
      var pincode=jQuery("#enterpincode").val();
     // alert(pincode);
      if(pincode==""){
        Swal.fire({
          title: 'Warning',
          text: "field is empty and must be filled",
          icon: 'warning',
          // showCancelButton: true,
          // confirmButtonColor: '#3085d6',
          // cancelButtonColor: '#d33',
          // confirmButtonText: 'Yes, delete it!'
        });
            }else{
              jQuery.ajax({
                type:'post',
                data:{pincode:pincode},
                url:'/checkifpincodeexists',
                success:function(resp){
                     //alert(resp);
                     if(resp==false){
                        // alert("sddd");
                      Swal.fire({
                        title: 'Warning',
                        text: "The pincode is invalid",
                        icon: 'warning',
                        // showCancelButton: true,
                        // confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#d33',
                        // confirmButtonText: 'Yes, delete it!'
                      });

                     }else if(resp==true){
                      Swal.fire({
                        title: 'Success',
                        text: "The pincode is valid",
                        icon: 'success',
                        // showCancelButton: true,
                        // confirmButtonColor: '#3085d6',
                        // cancelButtonColor: '#d33',
                        // confirmButtonText: 'Yes, delete it!'
                      });
                     }
                },
                error:function(){
                  Swal.fire({
                    title: 'Warning',
                    text: "An error occurred",
                    icon: 'warning',
                    // showCancelButton: true,
                    // confirmButtonColor: '#3085d6',
                    // cancelButtonColor: '#d33',
                    // confirmButtonText: 'Yes, delete it!'
                  });
                }
              });
            }
    });
    // jQuery(wrapper).on('click','.remove_button',function(e){
    //   e.preventDefault();
    // jQuery("#getaccesstoken").on('click',function(){
    //  // alert("bvcx");
    //   jQuery.ajax({
    //     type:'post',
    //     url:'/getaccesstoken',
    //       success:function(response){
    //         //console.log(response);
    //          console.log(response.data);
    //       },
    //       error:function(error){
    //       //  console.log(erro);
    //       }
    //   });
    // });
    // jQuery("#getaccesstoken").on('click',function(){
    //   alert("LKJHGF");
    // });
    // document.getElementById("getaccesstoken").addEventListener('click',(event)=>{
    //   event.preventDefault()
    //  axios.post('/get-token',{})
    //  .then((response)=>{
    //    console.log(response);
    //  })
    //  .catch((error)=>{
    //    console.log(error);
    //  })
    // });
    setInterval(showTime, 1000);
    function showTime() {
      let time = new Date();
      let hour = time.getHours();
      let min = time.getMinutes();
      let sec = time.getSeconds();
      am_pm = "AM";

      if (hour > 12) {
        hour -= 12;
        am_pm = "PM";
      }
      if (hour == 0) {
        hr = 12;
        am_pm = "AM";
      }

      hour = hour < 10 ? "0" + hour : hour;
      min = min < 10 ? "0" + min : min;
      sec = sec < 10 ? "0" + sec : sec;

      let currentTime = hour + ":"
          + min + ":" + sec + am_pm;

      document.getElementById("clock")
          .innerHTML = currentTime;
      // jQuery("#clock").innerHtml().val(currentTime);
    }
    showTime();

});
