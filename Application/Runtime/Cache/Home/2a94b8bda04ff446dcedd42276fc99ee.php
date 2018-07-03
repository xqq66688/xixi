<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<center>
 	<div>
 		搜索：
 		<select name="" id="sou">
 		   <option value="">请搜索</option>
 				<option value="1">品牌</option>
 				<option value="2">商铺</option>
 				<option value="3">分类</option>
 		</select>
 		<input type="text" id='goods_desc'>
 		<input type="button" value='搜索' id='search'>
 	</div>
 		<table border='1'>
			<thead id="head">
	 			<tr>
	 				<td>商品id</td>
	 				<td>所属品牌</td>
	 				<td>所属分类</td>
	 				<td>店铺名称</td>
	 				<td>商品名称</td>
	 				<td>商品简介</td>
	 				<td>商品价格</td>
	 				<td>商品货号</td>
	 			</tr>
 			</thead>
 			<tbody id='list'>
 				
 			
 			<?php if(is_array($data["list"])): foreach($data["list"] as $key=>$v): ?><tr>
 				<td><?php echo ($v["g_id"]); ?></td>
 				<td><?php echo ($v["brand_name"]); ?></td>
 				<td><?php echo ($v["cart_name"]); ?></td>
 				<td><?php echo ($v["shop_name"]); ?></td>
 				<td><?php echo ($v["goods_name"]); ?></td> 	
 				<td><?php echo ($v["goods_desc"]); ?></td>
 				<td><?php echo ($v["price"]); ?></td>
 				<td><?php echo ($v["goods_sn"]); ?></td>
 			</tr><?php endforeach; endif; ?>
 			</tbody>

 		</table>
 	<div id='page'>
					<?php echo ($data["page"]); ?>

		</div>
 	</center>
 </body>
 <script src='/lianxi/Public/jq.js'></script>
 <script>
	$(document).on('click','#page a,#search',function(event){
		event.preventDefault();
		var search=$("#sou").val();
		var url = $(this).attr('href');
		$.ajax({
			url:url,
			data:{search:search},
			dataType:'json',
			success:function(data){
				console.log(data);
				if (data.type=="0") {
					$('#page').html(data.page);
					$('#list').empty();
					$.each(data.list,function(k,v){
						var tr = $('<tr></tr>');
						tr.append('<td>'+v.g_id+'</td>');
						tr.append('<td>'+v.brand_name+'</td>');
						tr.append('<td>'+v.cart_name+'</td>');
						tr.append('<td>'+v.shop_name+'</td>');
						tr.append('<td>'+v.goods_name+'</td>');
						tr.append('<td>'+v.goods_desc+'</td>');
						tr.append('<td>'+v.price+'</td>');
						tr.append('<td>'+v.goods_sn+'</td>');
						$('#list').append(tr);
					})
				}else if(data.type=="1"){
					$('#page').html(data.page);
					$("#head").html("<tr><td>品牌id</td><td>品牌名称</td><td>商品名称</td><td>商品介绍</td></tr>")
					$('#list').empty();
					$.each(data.list,function(k,v){
						var tr = $('<tr></tr>');
						tr.append('<td>'+v.b_id+'</td>');
						tr.append('<td>'+v.brand_name+'</td>');
						tr.append('<td>'+v.goods_name+'</td>');
						tr.append('<td>'+v.goods_desc+'</td>');
						$('#list').append(tr);
					})
				}
			}
		})
	})
 </script>
 </html>