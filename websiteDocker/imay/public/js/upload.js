
/**
 * 把图片回写到img元素
 * @param sfilename
 * @param srcpath
 * @param thumbpath 上传后获取到的url
 * @param fname
 */
function getUploadFilename(sfilename,srcpath,thumbpath,fname){
	
	
	if(srcpath!="fail"){
		$("#s_"+sfilename).val(srcpath);
		$("#"+fname).val(srcpath);
		if(fname=="goodsImg"){
			$("#goodsThumbs").val(thumbpath);
		}
		$("#preview_"+sfilename).html("<img height='152'  src='"+ThinkPHP.ROOT+"/"+thumbpath+"'/>");
		
	}else{
		$("#s_"+sfilename).val("");
		$("#"+fname).val("");
	}
	
	
}


/**
 * 把图片回写到img元素
 * @param sfilename
 * @param srcpath
 * @param thumbpath 上传后获取到的url
 * @param fname
 */
function getQiNiuUploadFilename(sfilename,srcpath,thumbpath,fname){
	
	
	if(srcpath!="fail"){
		$("#s_"+sfilename).val(srcpath);
		$("#"+fname).val(srcpath);
		if(fname=="goodsImg"){
			$("#goodsThumbs").val(thumbpath);
		}
		$("#preview_"+sfilename).html("<img height='100' style='display: block;' src='"+thumbpath+"'/>").show();
		$('.pop-up-a').hide();
		$('#Filedata').siblings('span').hide();

		if(sfilename == 'Filedatas'){
			
			if($('input[name="checkbox"]').prop("checked")){
				$("#z_adFile").val(srcpath);
				$("#preview_z_"+sfilename).html("<img height='100'  src='"+srcpath+"'/>");
			}
		}
		
		if(sfilename == 'z_Filedatas'){
			$('input[name="checkbox"]').attr("checked",false)
		}
		
	}else{
		$("#s_"+sfilename).val("");
		$("#"+fname).val("");
	}
	
	
}
/**
 * 上传文件
 * @param filename 指定文件名
 * @param clas
 */
function updfile(filename,clas){
	var filepath = jQuery("#"+filename).val();
	var patharr = filepath.split("\\");
	var fnames = patharr[patharr.length-1].split(".");
	var ext = (fnames[fnames.length-1]);
		ext = ext.toLocaleLowerCase();	
	var flag = false;
	for(var i=0;i<filetypes.length;i++){
		if(filetypes[i]==ext){
			flag = true;
			break;
		}
	}
	
	if(flag){
		if(clas){
		   jQuery("#uploadform_"+filename).submit();
		  // alert(filename+','+clas);
	    }else{
	    	jQuery("#uploadform_"+filename).submit();
	    }
	}else{		
		alert("上传文件类型错误 (文档支持格式："+filetypes.join(",")+")");
		if(clas){
		    jQuery('#uploadform_'+filename)[0].reset();
		}else{
			jQuery("#"+clas+"uploadform_"+filename)[0].reset();
		}
		return;
	}	
}

/*
 * 获取图片宽高
 * id
 */
function checkImg(filename,clas){
	var input = document.getElementById(filename);
	
	if(input.files){
        //读取图片数据
		var f = input.files[0];
		var reader = new FileReader();
		
			reader.onload = function (e) {
				
				  var data = e.target.result;
				  var par ={};
				  //加载图片获取图片真实宽度和高度
				  var image = new Image();
				  image.onload=function(){
					  par.width = image.width;
					  par.height = image.height;
					  
					  var che =checkimgWidthHight(par.width,par.height);
					  if(che){
						  updfile(filename,clas);
					  }
					  //checkimgWidthHight(wid,hei);
					  //alert(width+'======'+height+"====="+f.size);
				  };
				  image.src= data;
		    };
		    reader.readAsDataURL(f);
		    
	}else{
		
		var image = new Image(); 
		image.onload =function(){
		  var width = image.width;
		  var height = image.height;
		  var fileSize = image.fileSize;
		  
		  
		  //checkimgWidthHight(wid,hei);
		  //alert(width+'======'+height+"====="+fileSize);
		}
		image.src = input.value;
		//return 1;

   }
	
	
}

/*
 * 判断宽高是否限制
 * 
 */
function checkimgWidthHight(wid,hei){
	if(wid>w_img){
		alert('上传图尺寸宽度最大'+w_img+'px');
		return ;
	}
	if(hei>h_img){
		alert('上传图尺寸高度最大'+h_img+'px');
		return ;
	}
	return true;
}
