Private Sub Label1_Click(Index As Integer)
'   version_control_v3.php  by Vincenzo Quaranta (MIT license, Expat)
'   vince.quaranta@gmail.com
'   script php per il controllo delle versioni di applicazioni client mediante l'uso di chiamate http GET
'   gen 2017

Dim result9 As String
Dim url9 As String
Dim mysplit() As String
url9 = "http://cosahodiusato.altervista.org/version_control_v3.php?name=SuperProg&version=20170208&note=ciao"
result9 = WebRequest(url9)
mysplit = Split(result9, "<br>")
MsgBox (">applicazione>----- " & mysplit(0) & vbCrLf & ">versione>----- " & mysplit(1) & vbCrLf & ">note>----- " & mysplit(2) & vbCrLf & ">ultima versione>----- " & mysplit(3) & vbCrLf & ">check ultima versione>----- " & mysplit(4))
End Sub

Public Function WebRequest(url As String) As String
'   version_control_v3.php  by Vincenzo Quaranta (MIT license, Expat)
'   vince.quaranta@gmail.com
'   script php per il controllo delle versioni di applicazioni client mediante l'uso di chiamate http GET
'   gen 2017

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

