<div class="container text-center">
   <h5>Your shortened url is : </h5>
   <input onclick="copy()" value="<?= $shortLink?>" id="shortened-link-input" />
   <br />
   <br />
   <p>
      <span id="message" onclick="copy()">Click the text above to copy to clipboard.</span>
      <a class='text-gray dashed' href='https://<?= $shortLink?>'>Click here to visit.</a>
   </p>
   <br />
   <a href="" class="btn btn-default">Shorten New Link</a>
</div>


<script>
   var input = document.getElementById("shortened-link-input");
   input.focus();
   input.select();
   
   function copy() {
     if (document.execCommand("Copy")) {
       document.getElementById("message").innerHTML  = "Link copied to clipboard. ";
     }
   }
   
</script>