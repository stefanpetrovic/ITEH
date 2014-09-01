<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('admin/do_upload');?>

<input type="file" name="userfile" size="20" />
<input type="text" name="bla" value="bla"/>
<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>