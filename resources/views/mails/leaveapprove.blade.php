<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Leave Application Successful</title>
    <style type="text/css">
        body {
            margin: 0; 
            padding: 0; 
            min-width: 100%!important;
        }
        img {
            height: auto;
        }
        .content {
            width: 100%;
            max-width: 600px;
        }
        .header {
            padding: 40px 30px 20px 30px;
        }
        .innerpadding {
            padding: 30px 30px 30px 30px;
        }
        .borderbottom {
            border-bottom: 1px solid #f2eeed;
        }
        .subhead 
        {
            font-size: 15px; 
            color: #ffffff; 
            font-family: sans-serif; 
            letter-spacing: 10px;
        }
        .h1, .h2, .bodycopy {
            color: #153643; 
            font-family: sans-serif;
        }
        .h1 {
            font-size: 33px; 
            line-height: 38px; 
            font-weight: bold;
        }
        .h2 {
            padding: 0 0 15px 0; font-size: 24px; 
            line-height: 28px; 
            font-weight: bold;
        }
        .bodycopy {
            font-size: 16px; 
            line-height: 22px;
        }
        .button {
            text-align: center; 
            font-size: 18px; 
            font-family: sans-serif; 
            font-weight: bold; 
            padding: 0 30px 0 30px;
        }
        .button a {
            color: #ffffff; 
            text-decoration: none;
        }
        .footer {
            padding: 20px 30px 15px 30px;
        }
        .footercopy {
            font-family: sans-serif; font-size: 14px; color: #ffffff;
        }
        .footercopy a {
            color: #ffffff; 
            text-decoration: underline;
        }
        @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
            body[yahoo] .hide {
                display: none!important;
            }
            body[yahoo] .buttonwrapper {
                background-color: transparent!important;
            }
            body[yahoo] .button {
                padding: 0px!important;
            }
            body[yahoo] .button a {
                background-color: #effb41; 
                padding: 15px 15px 13px!important;
            }
            body[yahoo] .unsubscribe {
                display: block; 
                margin-top: 20px; 
                padding: 10px 50px; 
                background: #2f3942; 
                border-radius: 5px; 
                text-decoration: none!important; 
                font-weight: bold;
            }
        }
        @media only screen and (min-device-width: 601px) {
            .content {
                width: 600px !important;
            }
            .col425 {
                width: 425px!important;
            }
            .col380 {
                width: 380px!important;
            }
        }
    </style>
</head>
<body yahoo bgcolor="#ffffff">
    <table width="100%" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <tbody>
                            <tr>
                                <td align="center">
                                    <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td align="center" valign="top" background="https://raw.githubusercontent.com/Mamanggans/For_css_-_JS_VNLeave/master/img_VNLeave/for_bg.jpg" bgcolor="#66809b" style="background-size:cover; background-position:top;height=" 400""="">
                                                    <table class="col-600" width="600" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td height="40"></td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="line-height: 0px;">
                                                                    <img style="display:block; line-height:0px; font-size:0px; border:0px;" src="https://raw.githubusercontent.com/Mamanggans/For_css_-_JS_VNLeave/master/img_VNLeave/email_logo.png" width="109" height="103" alt="logo">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" style="font-family: 'Raleway', sans-serif; font-size:37px; color:#FE7D06; line-height:24px; font-weight: bold; letter-spacing: 7px;">
                                                                    VN&nbsp;<span style="font-family: 'Raleway', sans-serif; font-size:37px; color: dimgray; line-height:39px; font-weight: 300; letter-spacing: 7px;">HR</span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="50"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="h2">
                                        Leave Approval For {{ $approved['title'] }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bodycopy">
                                        We are glad to inform that your leave application on {{ $approved['apply_date'] }} has been approved by your superior.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom">
                            <table class="col380" align="left" border="0" cellpadding="10" cellspacing="2" style="width: 100%; max-width: 380px;">
                                <td class="h2">
                                    Leave Data 
                                </td>
                                <tr>
                                    <td>Leave Type</td>
                                    <td>:</td>
                                    <td>{{ $approved['leaveType'] }}</td>
                                </tr>
                                <tr>
                                    <td>Leave Status</td>
                                    <td>:</td>
                                    <td>{{ $approved['status'] }}</td>
                                </tr>
                                <tr>
                                    <td>Leave Start</td>
                                    <td>:</td>
                                    <td>{{ $approved['start_date'] }}</td>
                                </tr>
                                <tr>
                                    <td>Leave End</td>
                                    <td>:</td>
                                    <td>{{ $approved['end_date'] }}</td>
                                </tr>
                                <tr>
                                    <td>Days Taken</td>
                                    <td>:</td>
                                    <td>{{ $approved['date_leave'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding borderbottom">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td class="h2">
                                        Remarks from Superior
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bodycopy">
                                        {{ $approved['approver_remarks'] ?? 'No remarks given by your superior.' }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="innerpadding bodycopy">
                            If you wish to know more about your leave application, kindly go to <a href="http://127.0.0.1:8000">VN Leave</a>.
                        </td>
                    </tr>
                    <tr>
                        <td class="footer" bgcolor="#44525f">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" class="footercopy">
                                        Copyright VN Human Resource © 2022<br>
                                        <span class="hide">+603-4144-1220 | support@vn.net.my</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>