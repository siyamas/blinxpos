Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "D:\www\htdocs\pos\scriptrunner.bat" & Chr(34), 0
Set WinScriptHost = Nothing