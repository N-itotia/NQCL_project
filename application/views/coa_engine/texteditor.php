<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script type="text/javascript">
<!--
// Instantiate the Shell object and invoke its execute method.
var oShell = new ActiveXObject("Shell.Application");

var commandtoRun = "C:\\Winnt\\Notepad.exe";
if (inputparms != "") {
  var commandParms = document.Form1.filename.value;
}

// Invoke the execute method.  
oShell.ShellExecute(commandtoRun, commandParms, "", "open", "1");
</script>
</head>

<body>

<input type="button" value="Run!" onclick="runCmd('notepad.exe', '%programfiles%\file.txt');" />
</body>
</html> 