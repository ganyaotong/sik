<div class="tabbable">

  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">消费情况</a></li>
    <!--
    <li><a href="#tab2" data-toggle="tab">充值</a></li>
-->
    <li><a href="#tab3" data-toggle="tab">绿叶卡</a></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
       <script src="/lib/Chart.js" type="text/javascript"></script>
        <p>本网定期给用户免费发放绿叶卡</p>
<p>总资产: <?php echo $score ?>绿叶</p>
<!--
        <canvas id="myChart" width="480" height="400"></canvas>
        <div class = "pull-right col-sm-3 well">
            <p>收支记录</p>
            <ul class="unstyled">
                <li>2014.4.10 : 购买10绿叶</li>
                <li>2014.4.30 : 支付5绿叶</li>
            </ul>
        </div>

       -->
        
    </div>
    <div class="tab-pane" id="tab2">
      <p class="well">总资产： <?php echo $score ?>绿叶</p>
      <p>购买绿叶数量：</p>
      <select >
  <option>5</option>
  <option>10</option>
  <option>20</option>
</select>
    <p>应付款：10元</p>
    <label class="checkbox">
      <input type="checkbox" onchange="return checkboxChange()" id="checkboxgo">  我接受增值服务条款，并了解购买后无法退款。<a href="">增值服务条款</a>
    </label>
    <a id="btnpay" class="btn btn-primary disabled">确认购买</a>
    </div>
    <div class="tab-pane" id="tab3">
        <img src="view/img/giftcard.png" class="offset1" width="320"/>
      <form class="col-sm-3">
  <fieldset>
    <legend>绿叶卡</legend>
    <label>卡密</label>
    <input type="text" id="giftcardpwd" placeholder="输入卡密......">
    <span class="help-block">查看我们绿叶卡<a href="">政策与条款</a></span>
  </fieldset>
  <a class="btn " id="giftcardcommit">提交</a>
</form>
      
    </div>
  </div>

</div>

<script type="text/javascript">
function checkboxChange(){
    if($("#checkboxgo").is(':checked')){
        $('#btnpay').removeClass('disabled'); 
    }else{
        $('#btnpay').addClass('disabled'); 
    }
    
}

var ready = (function(){

    $('#giftcardcommit').click(function(event) {
        /* Act on the event */
        var val = $('#giftcardpwd').val();
        $.post('<?php echo $giftcardActivation ?>',
         {
            pwd : val
         },
          function(data, textStatus, xhr) {
            /*optional stuff to do after success */
            if (data == 1) {
                alert("充值成功");
                location.reload();
            }else if(data==2){
                alert("充值失败");
            }else if(data==3){
                alert("充值错误");
            }
            

        });
    });
  var ctx = $("#myChart").get(0).getContext("2d");
  var data = {
    labels : ["一月份","二月份","三月份","四月份","五月份","六月份","七月份","八月份","九月份","十月份","十一月份","十二月份"],
    datasets : [
        {
            fillColor : "rgba(151,187,205,0.5)",
            strokeColor : "rgba(151,187,205,1)",
            pointColor : "rgba(151,187,205,1)",
            pointStrokeColor : "#fff",
            data : [28,48,40,19,96,27,100]
        }
    ]
}

 new Chart(ctx).Bar(data,{
                
    //Boolean - If we show the scale above the chart data           
    scaleOverlay : false,
    
    //Boolean - If we want to override with a hard coded scale
    scaleOverride : false,
    
    //** Required if scaleOverride is true **
    //Number - The number of steps in a hard coded scale
    scaleSteps : null,
    //Number - The value jump in the hard coded scale
    scaleStepWidth : null,
    //Number - The scale starting value
    scaleStartValue : null,

    //String - Colour of the scale line 
    scaleLineColor : "rgba(0,0,0,.1)",
    
    //Number - Pixel width of the scale line    
    scaleLineWidth : 1,

    //Boolean - Whether to show labels on the scale 
    scaleShowLabels : false,
    
    //Interpolated JS string - can access value
    scaleLabel : "<%=value%>",
    
    //String - Scale label font declaration for the scale label
    scaleFontFamily : "'Arial'",
    
    //Number - Scale label font size in pixels  
    scaleFontSize : 12,
    
    //String - Scale label font weight style    
    scaleFontStyle : "normal",
    
    //String - Scale label font colour  
    scaleFontColor : "#666",    
    
    ///Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines : true,
    
    //String - Colour of the grid lines
    scaleGridLineColor : "rgba(0,0,0,.05)",
    
    //Number - Width of the grid lines
    scaleGridLineWidth : 1, 
    
    //Boolean - Whether the line is curved between points
    bezierCurve : true,
    
    //Boolean - Whether to show a dot for each point
    pointDot : true,
    
    //Number - Radius of each point dot in pixels
    pointDotRadius : 3,
    
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth : 1,
    
    //Boolean - Whether to show a stroke for datasets
    datasetStroke : true,
    
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth : 2,
    
    //Boolean - Whether to fill the dataset with a colour
    datasetFill : true,
    
    //Boolean - Whether to animate the chart
    animation : true,

    //Number - Number of animation steps
    animationSteps : 60,
    
    //String - Animation easing effect
    animationEasing : "easeOutQuart",

    //Function - Fires when the animation is complete
    onAnimationComplete : null})

});

        </script>