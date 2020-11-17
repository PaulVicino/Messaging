<?php

include('database_conn.php');

// make sure connected to database

session_start();

if (!isset($_SESSION['username']))
{
	header("location:messengerLogin.php");
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="Projects made by Paul Vicino">
	<meta name="keywords" content="CS projects, resume, messenger, messenger app">
	<meta name="author" content="Paul Vicino">
	<title>Contacts Page</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>

      <header>
		<div class="container">
			<div id="brand">
				<h1><span class="highlight">SonicDeveloper</span></h1>
			</div>
			<nav>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li class="current"><a href="projects.html">Projects</a></li>
					<li><a href="about.html">About</a></li>
				</ul>
			</nav>
		</div>
	</header>

      <section id = contacts>
		<div class="loginSection">
			<p align="right">User: <?php echo $_SESSION['username']; ?> <a href="logout.php">Logout</a></p>
			<h1>Send Message</h1>
				<div class="table-responsive">

					<h1 align="center">Contacts</h1>

					<div id = "user_details"></div>

					<div id ="user_model_details"></div>
				</div>

				<!--
				<div class="search-box">
		                  <input type="text" autocomplete="off" placeholder="Search users..." name = "user">
		                  <div class = "result"></div>
		            </div>
			-->
		</div>

      </section>

</body>
</html>

<script type="text/javascript">
$(document).ready(function(){

	fetch_user();

	setInterval(function(){
		update_last_activity();
		fetch_user();
            update_chat_history_data();
	}, 5000);

	function fetch_user()
	{
		$.ajax({
			url:"fetch_user.php",
			method:"POST",
			success: function(data){
				$('#user_details').html(data);
			}
		})
	}

	function update_last_activity()
	{
		$.ajax({
			url: "update_activity.php",
			sucess:function()
			{

			}
		})
	}

	function make_chat_dialog_box(to_user_id, to_user_name)
	{
		 var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Message'+to_user_name+'">';
		 modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
		 modal_content += fetch_user_chat_history(to_user_id);
		 modal_content += '</div>';
		 modal_content += '<div class="form-group">';
		 modal_content += '<textarea name="message_'+to_user_id+'" id="message_'+to_user_id+'" class="form-control"></textarea>';
		 modal_content += '</div><div class="form-group" align="right">';
		 modal_content += '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
		 $('#user_model_details').html(modal_content);
	 }

	$(document).on('click', '.start_chat', function(){
		var to_user_id = $(this).data('touserid');
		var to_user_name = $(this).data('tousername');
		make_chat_dialog_box(to_user_id, to_user_name);
		$("#user_dialog_"+to_user_id).dialog({
			autoOpen:false,
			width:400
		});
		$('#user_dialog_'+to_user_id).dialog('open');
	});

	$(document).on('click', '.send_chat', function(){
		var to_user_id = $(this).attr('id');
		var message = $('#message_'+to_user_id).val();
		$.ajax({
			url: "contactForm.php",
			method:"POST",
			data:{to_user_id:to_user_id, message:message},
			success:function(data){
				$('#message_'+to_user_id).val(' ');
				$('#chat_history_'+to_user_id).html(data);
			}
		})
	});

      function fetch_user_chat_history(to_user_id)
      {
            $.ajax({
                  url: "fetch_user_chat_history.php",
                  method:"POST",
                  data:{to_user_id:to_user_id},
                  success:function(data){
                        $('#chat_history_'+to_user_id).html(data);
                  }
            })
      }

      function update_chat_history_data()
      {
            $('.chat_history').each(function(){
                  var to_user_id = $(this).data('touserid');
                  fetch_user_chat_history(to_user_id);
            });
      }

      $(document).on('click', '.ui-button-icon', function(){
            $('.user_dialog').dialog('destroy').remove();
      });

});
</script>
