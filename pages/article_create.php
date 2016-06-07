<?php
	include_once('initial.php');
	include_once('connect.php');
	if(!isset($_SESSION['user']))
	{
		header("location:index.php");
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
	    <title>
	    	發表文章
	    </title>
	    <?php include 'head.php'; ?>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
	    <script type="text/javascript"  src="additional-methods.min.js"></script>
	    <script>
	        $(document).ready(function($) {

	            jQuery.validator.addMethod("none", function(value, element) {
	                return value.split(" ").length - 1 < value.length;
	            }, "請勿輸入空白內容");


	            $("#form_article").validate({
	                submitHandler: function(form) {

	                    $(form).ajaxSubmit({
	                        type: "POST",
	                        url: "article_send.php",
	                        dataType: "text",
	                        data: $('#form_article').serialize(),

	                    });

	                },

	                errorPlacement: function(error, element) {

	                    if (element.is(':radio') || element.is(':checkbox')) {
	                        var eid = element.attr('name');
	                        $('input[name=' + eid + ']:last').next().after(error);
	                    } else {
	                        error.insertAfter(element);
	                    }
	                },



	                rules: {

	                	title:{
	                		maxlength:30,
	                		required:true,
	                		none:true,
	                	},

	                    content: {

	                        none: true,
	                        required: true,

	                    }

	                },

	                messages: {

	                	title: {
	                		maxlength:"標題長度不得超過30字",
	                		required:"請輸入標題",
	                	},

	                    content: {
	                        required: "請輸入留言",
	                    }

	                }

	            });

	        });
	        </script>

	        <script type="text/javascript">
	            var isChange = false;
	            $(function () {

	            	$("#submit").click(function () {
	            	    $(window).unbind('beforeunload');
	            	});

	                $("textarea").change(function () {
	                    isChange = true;
	                    $(this).addClass("editing");
	                });

	                $(window).bind('beforeunload', function (e) {
	                    if (isChange || $(".editing").get().length > 0) {
	                        return '文章尚未發表，是否確定要離開？';
	                    }
	                })
	            });

	        </script>

	        <style type="text/css">
	        	.error {
	        	    color: #D82424;
	        	    font-weight: normal;
	        	    font-family: "微軟正黑體";
	        	    display: block;
	        	    padding: 1px;
	        	}
	        	
	        	.table {
	        	    margin: auto;
	        	}
	        	
	        	.table-bordered > tbody > tr > td,
	        	.table-bordered > tfoot > tr > th {
	        	    font-color: rgb(0, 0, 204);
	        	    font-family: "微軟正黑體";
	        	}
	        	body{
	        		font-family: "微軟正黑體";
	        	}
	        	textarea {
	        	   resize:none;
	        	}
	        </style>
	</head>
	<body>
	<div class="container">
		<div class="row">
		    <div class="col-md-12">
		        <div class="panel panel-primary">
		            <div class="panel-heading text-center">發表文章至留言區</div>
		            <div class="panel-body panel-height">
		                <form class="form-horizontal disable" id="form_article" role="form" method='POST' action='article_send.php'>
		                    <fieldset>
		                        <div class="form-group">
		                            <table class="table table-bordered col-md-12 col-md-offset-1">
		                                <tbody>
		                                    <tr>
		                                        <td class="col-md-2">
		                                        <div style="margin-bottom:20px;">標題</div>
		                                        <div >(長度限30字內)</div>
		                                        </td>
		                                        <td>
		                                        	<textarea class=" form-control col-md-6" id="title" name="title" value="1" rows="1"></textarea>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                    	<td class="col-md-2 text-center">
		                                    		<div class="col-sm-1 pull-left">文</div>
		                                    		<div class="col-sm-1" style="margin-top:30px;">章</div>
		                                    		<div class="col-sm-1" style="margin-top:60px;">內</div>
		                                    		<div class="col-sm-1" style="margin-top:90px;">容</div>
		                                    	</td>
		                                        <td class="col-md-10">
		                                            <textarea class="form-control col-md-6" cols="8" rows="3" id="content" name="content"></textarea>
		                                        </td>
		                                    </tr>

		                                    <tr>
		                                    	<td colspan="8">
		                                    		<button id="submit" type='submit' class="btn btn-info">發表</button>
		                                    		<a class="btn btn-default" href='boardarea.php'>回留言板</a>
		                                    	</td>
		                                    </tr>

		                                </tbody>
		                            </table>
		                        </div>
		                    </fieldset>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
		
	</body>
	</html>
