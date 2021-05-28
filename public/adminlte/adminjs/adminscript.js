jQuery(document).ready(function(){
    jQuery("#currentpassword").keyup(function(){
        var currentpassword=jQuery("#currentpassword").val();
       // alert(password);
        jQuery.ajax({
            type:'post',
            url:'/admin/checkcurrentpassword',
            data:{currentpassword:currentpassword},
            success:function(resp){
               //alert(resp);
                if(resp==false){
                    jQuery("#checkcurrentpassword").html("<font color=red>Current password is in correct</>");
                }else if(resp==true){
                    jQuery("#checkcurrentpassword").html("<font color=green>password is correct</>");
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
      //  alert(password);
       // alert(password_confirmation);
        jQuery.ajax({
            type:'post',
            url:'/admin/confirmationofpasswords',
            data:{password:password,password_confirmation:password_confirmation},
            success:function(resp){
                  //alert(resp);
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
  //  jQuery(".updatesectionstatus").click(function(){
        jQuery(document).on("click",".updatesectionstatus",function(){
     
        var status=jQuery(this).text();
        var section_id=jQuery(this).attr("section_id");
     jQuery.ajax({
         type:'post',
         url:'/admin/updatesectionstat',
         data:{status:status,section_id:section_id},
         success:function(resp){
             console.log(resp);
           
           if(resp['status']==0){
               jQuery("#section-"+section_id).html("In active");
           }else if(resp['status']==1){
            jQuery("#section-"+section_id).html("Active");

           }
         },
         error:function(){
             alert("error");
         }
     });
    });

    //updatecategorystatus
    
   // jQuery(".updatecategorystatus").click(function(){
        jQuery(document).on("click",".updatecategorystatus",function(){

        var status=jQuery(this).text();
        var category_id=jQuery(this).attr("category_id");
     jQuery.ajax({
         type:'post',
         url:'/admin/updatecategorystatu',
         data:{status:status,category_id:category_id},
         success:function(resp){
             console.log(resp);
           
           if(resp['status']==0){
               jQuery("#category-"+category_id).html("In active");
           }else if(resp['status']==1){
            jQuery("#category-"+category_id).html("Active");

           }
         },
         error:function(){
             alert("error");
         }
     });
    });
//updatecategorystatus


//jQuery(".updateproductstatus").click(function(){
    jQuery(document).on("click",".updateproductstatus",function(){

    var status=jQuery(this).text();
    var product_id=jQuery(this).attr("product_id");
 jQuery.ajax({
     type:'post',
     url:'/admin/updateproductstatus',
     data:{status:status,product_id:product_id},
     success:function(resp){
         console.log(resp);
       
       if(resp['status']==0){
           jQuery("#product-"+product_id).html("In active");
       }else if(resp['status']==1){
        jQuery("#product-"+product_id).html("Active");

       }
     },
     error:function(){
         alert("error");
     }
 });
});
//update attribute staus
//jQuery(".updateattributestatus").click(function(){
    jQuery(document).on("click",".updateattributestatus",function(){

    var status=jQuery(this).text();
    var attribute_id=jQuery(this).attr("attribute_id");
 jQuery.ajax({
     type:'post',
     url:'/admin/updateproductattributestatus',
     data:{status:status,attribute_id:attribute_id},
     success:function(resp){
         console.log(resp);
       
       if(resp['status']==0){
           jQuery("#attribute-"+attribute_id).html("In active");
       }else if(resp['status']==1){
        jQuery("#attribute-"+attribute_id).html("Active");

       }
     },
     error:function(){
         alert("error");
     }
 });
});
//update image staus
//jQuery(".updateimagestatus").click(function(){
    jQuery(document).on("click",".updateimagestatus",function(){
   
    var status=jQuery(this).text();
    var image_id=jQuery(this).attr("image_id");
 jQuery.ajax({
     type:'post',
     url:'/admin/updateimagestatus',
     data:{status:status,image_id:image_id},
     success:function(resp){
         console.log(resp);
       
       if(resp['status']==0){
           jQuery("#imagestatus-"+image_id).html("In active");
       }else if(resp['status']==1){
        jQuery("#imagestatus-"+image_id).html("Active");
       }
     },
     error:function(){
         alert("error");
     }
 });
});
   
//update brand staus
//jQuery(".updatebrandstatus").click(function(){
jQuery(document).on("click",".updatebrandstatus",function(){
    var status=jQuery(this).children("i").attr("status");
    var brand_id=jQuery(this).attr("brand_id");
 jQuery.ajax({
     type:'post',
     url:'/admin/updatebrandstatus',
     data:{status:status,brand_id:brand_id},
     success:function(resp){
         console.log(resp);
       
       if(resp['status']==0){
           jQuery("#brand-"+brand_id).html("<i title='In active' class='fas fa-toggle-off' aria-hidden='true' status='In active'></i>");
       }else if(resp['status']==1){
        jQuery("#brand-"+brand_id).html("<i title='Active' class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
       }
     },
     error:function(){
         alert("error");
     }
 });
});
//update banner status
jQuery(document).on("click",".updatebannerstatus",function(){
    var status=jQuery(this).children("i").attr("status");
    var banner_id=jQuery(this).attr("banner_id");
 jQuery.ajax({
     type:'post',
     url:'/admin/updatebannerstatus',
     data:{status:status,banner_id:banner_id},
     success:function(resp){
         console.log(resp);
       
       if(resp['status']==0){
           jQuery("#banner-"+banner_id).html("<i title='In active' class='fas fa-toggle-off' aria-hidden='true' status='In active'></i>");
       }else if(resp['status']==1){
        jQuery("#banner-"+banner_id).html("<i title='Active' class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
       }
     },
     error:function(){
         alert("error");
     }
 });
});
//update couponstatus
//update banner status
jQuery(document).on("click",".updatecouponstatus",function(){
    var status=jQuery(this).children("i").attr("status");
    var coupon_id=jQuery(this).attr("coupon_id");
    //alert(coupon_id);
 jQuery.ajax({
     type:'post',
     url:'/admin/updatecouponstatus',
     data:{status:status,coupon_id:coupon_id},
     success:function(resp){
       //  alert(resp);
         console.log(resp);
       
       if(resp['status']==0){
           jQuery("#coupon-"+coupon_id).html("<i title='In active' class='fas fa-toggle-off' aria-hidden='true' status='In active'></i>");
       }else if(resp['status']==1){
        jQuery("#coupon-"+coupon_id).html("<i title='Active' class='fas fa-toggle-on' aria-hidden='true' status='Active'></i>");
       }
     },
     error:function(){
         alert("error");
     }
 });
});
//section on change
    jQuery("#sectiononchange").change(function(){
        //var section_id=jQuery("#sectiononchange").val();
        var section_id=jQuery(this).val();
      //  alert(section_id);
        jQuery.ajax({
            type:'post',
            url:'/admin/updateadmincategories',
            data:{section_id:section_id},
            success:function(data){
             console.log(data);
              jQuery("#appendcategorieshere").html(data);
            },
            error:function(){
                alert("error");
            }
        });
    });
    //confirm delete
    /*jQuery(".confirmdelete").click(function(){
        var name=jQuery(this).attr("name");
       if(confirm("Do you really wanna trash "+name+"?")){
           return true;
       }
           return false;
       
    });*/
//sweetalert2confirmdelete

   // jQuery(".confirmdelete").click(function(){
    jQuery(document).on("click",".confirmdelete",function(){
        var record=jQuery(this).attr("record");
        var recordid=jQuery(this).attr("recordid");
        //alert(record);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location.href="/admin/delete-"+record+"/"+recordid;
            }
          });
       
    });
    //products attributes add removescript
    var maxfield=10;
    var addButton=jQuery(".add_button");
    var wrapper=jQuery(".field_wrapper");
    var fieldhtml='<div><input type="text" name="size[]"  placeholder="size" style="width:100px;margin-top:5px;margin-left:2px" /><input type="text" placeholder="sku" name="sku[]" style="width:100px;margin-top:5px;margin-left:2px" /><input type="number" placeholder="price" name="price[]" style="width:100px;margin-top:5px;margin-left:2px" /><input type="number" placeholder="stock" name="stock[]" style="width:100px;margin-top:5px;margin-left:2px" /><a href="javascript:void(0);" class="remove_button">Remove</a></div>';
     var x=1;
     jQuery(addButton).click(function(){
         if(x<maxfield){
             x++;
             jQuery(wrapper).append(fieldhtml);

         }
     });
     jQuery(wrapper).on('click','.remove_button',function(e){
         e.preventDefault();
         jQuery(this).parent('div').remove();
         x--;
     });

   jQuery("#manualcoupon").click(function(){
       jQuery("#couponfield").show()
   });

   jQuery("#automaticcoupon").click(function(){
    jQuery("#couponfield").hide()
});
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

});