jQuery(document).ready(function(){
   $.ajaxSetup({
     headers:{
       'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
     }
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
    jQuery(document).on('click','.btnItemUpdate',function(){
     if(jQuery(this).hasClass('qtyMinus')){
       var quantity=jQuery(this).prev().val();
      if(quantity<=1){
        alert("You cannot reduce the quantity any further");
        return false;
      }else{
             new_qty=parseInt(quantity)-1;
      }
     }
     if(jQuery(this).hasClass('qtyPlus')){
       var quantity=jQuery(this).prev().prev().val();
       new_qty=parseInt(quantity)+1;
     }
     //alert(new_qty);
     var cartid=jQuery(this).data('cartid');
    // alert(cartid);
    jQuery.ajax({
         type:'post',
         url:'/updatecartquantitywithajax',
         data:{"cartid":cartid,"qty":new_qty},
         success:function(resp){
          // alert(resp.status);
          if(resp.status==false){
            alert(resp.message);
          }
          //alert(resp.TotalCartItems); 
          $(".ttcartitems").html(resp.TotalCartItems);
         jQuery("#appendcartitems").html(resp.view);
         },
         error:function(){
           alert("error");
         }
    });


    });
    
   
 

      //delete cart item
      jQuery(document).on('click','.btnItemDelete',function(){
        var cartid=jQuery(this).data('cartid');
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
          /* error:function(){
              alert("error");
            }*/
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
    
});