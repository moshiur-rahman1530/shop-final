$(".dropbtn").click(function() {
    $("#myDropdown").toggleClass("show");
  });


 
  function totalCountCart(){
          axios.get('/allCartItem').then(function(response){

              if (response.status==200 && response.data) {
                  var data = response.data;
                  $('.totalCartCount').html("<span>"+data+"</span>");
              } else {
                $('.totalCartCount').html("<span>"+0+"</span>");
              }

          }).catch(function(error){
            $('.totalCartCount').html("<span>"+0+"</span>");
          })
      }


      function subtotalProductPrice(){
        axios.get('/subtotal').then(function(response){

          if (response.status==200 && response.data) {
              var data = response.data;
              $('.totalCartCount').html("<span>"+data+"</span>");
          } else {
            toastr.error('Error From Cart Product Counting!!');
          }

      }).catch(function(error){
        $('.totalCartCount').html("<span>"+0+"</span>");
      })
      }



      // function changePhoto() {
      //   var link = "https://picsum.photos/id/1/200/300";
        
        
      //   const boxes = document.querySelectorAll('#userImgStyle');
      //   console.log(boxes); 
        
      //   boxes[0].setAttribute('src',link);
      // }


      
