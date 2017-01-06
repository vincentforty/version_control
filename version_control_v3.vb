Private Sub Label1_Click(Index As Integer)
'   version_control_v3.php  by Vincenzo Quaranta (MIT license, Expat)
'   vince.quaranta@gmail.com
'   script per il controllo delle versioni di applicazioni client mediante l'uso di chiamate http GET
'   gen 2017
'
'   chiamata della funzione WebRequest da parte della applicazione visual basic 
'
Dim result9 As String
Dim url9 As String
Dim mysplit() As String
url9 = "http://vincentforty.weebly.com/version_control_v3.php?name=MiaApplicazione&version=20170106114020&note=ciao"
result9 = WebRequest(url9)
mysplit = Split(result9, "<br>")
MsgBox (">applicazione>----- " & mysplit(0) & vbCrLf & ">versione>----- " & mysplit(1) & vbCrLf & ">note>----- " & mysplit(2) & vbCrLf & ">ultima versione>----- " & mysplit(3) & vbCrLf & ">check ultima versione>----- " & mysplit(4))
End Sub

Public Function WebRequest(url As String) As String
'   version_control_v3.php  by Vincenzo Quaranta (MIT license, Expat)
'   vince.quaranta@gmail.com
'   script per il controllo delle versioni di applicazioni client mediante l'uso di chiamate http GET
'   gen 2017
'
'   funzione WebRequest per le chiamate da applicazioni Visual Basic
'
    Dim http As Object
    Set http = CreateObject("MSXML2.XMLHTTP")
    http.Open "GET", url, False
    http.Send
    If http.Status = 200 Then
       WebRequest = http.responseText
    Else
       WebRequest = "Errore"
    End If
    Set http = Nothing
End Function

