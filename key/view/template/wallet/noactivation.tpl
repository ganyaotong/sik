 <div class="hero-unit">
    <h2>钱包</h2>
    <p>此帐户尚未启用钱包功能</p>
    <a  class="btn btn-primary" id="activation">点此启用</a>
</div>


<script type="text/javascript">
    $(document).ready(function(){
  
 $('#activation').click(function(){
        $.get("<?php echo $walletactivation ?>", function(result){
            //$("div").html(result);
            if (result == "1") {
                alert("激活成功");
                location.reload();
            }else{
                alert("激活失败");
            }
        });
});
});

        </script>