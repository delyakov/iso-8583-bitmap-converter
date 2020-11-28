<!DOCTYPE html>
<html lang="en">
<head>
  <title>ISO 8583 Bitmap Converter</title>
  <meta charset="utf-8">
  <style type="text/css">
    h1 { text-align: center; margin-bottom: 40px; }
	.table { display:inline-block; border-collapse:collapse; border-spacing:0; }
	.table-1, .table-2 { margin-right: 50px; }
	table { border-collapse:collapse; border-spacing:0; }
	td { border-right: 1px solid rgb(200, 200, 200); padding: 0 10px; }
	table td:nth-child(4) { border-right: 0px; }
	.sb-btn { display:block; } 
	.sb-btn span { margin-left: 6%; }
	.sb-btn input { padding: 5px 15px; margin: 25px 3px 0 14px; }
	p { font-size: 18px; margin: 22px 0 10px 14px; }
	form h2 { margin-left: 14px; }
  </style>
</head>
<body>
<?php
$tr = "<p>Bitmap string: 0000000000000000&nbsp;&nbsp;&nbsp;0000000000000000&nbsp;&nbsp;&nbsp;0000000000000000</p>";
if(isset($_POST["submitBtn"])) {
$str1 = "";
for($i = 0; $i < 64; $i++) {
    $x = isset($_POST["inbit{$i}"]) ? 1 : 0;
    $str1 .= $x;
}
$str2 = "";
for($i = 64; $i < 128; $i++) {
    $x = isset($_POST["inbit{$i}"]) ? 1 : 0;
    $str2 .= $x;
}
$str3 = "";
for($i = 128; $i < 192; $i++) {
    $x = isset($_POST["inbit{$i}"]) ? 1 : 0;
    $str3 .= $x;
}
function convBase($numberInput, $fromBaseInput, $toBaseInput)
{
    if ($fromBaseInput==$toBaseInput) return $numberInput;
    $fromBase = str_split($fromBaseInput,1);
    $toBase = str_split($toBaseInput,1);
    $number = str_split($numberInput,1);
    $fromLen=strlen($fromBaseInput);
    $toLen=strlen($toBaseInput);
    $numberLen=strlen($numberInput);
    $retval='';
    if ($toBaseInput == '0123456789')
    {
        $retval=0;
        for ($i = 1;$i <= $numberLen; $i++)
            $retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
        return $retval;
    }
    if ($fromBaseInput != '0123456789')
        $base10=convBase($numberInput, $fromBaseInput, '0123456789');
    else
        $base10 = $numberInput;
    if ($base10<strlen($toBaseInput))
        return $toBase[$base10];
    while($base10 != '0')
    {
        $retval = $toBase[bcmod($base10,$toLen)].$retval;
        $base10 = bcdiv($base10,$toLen,0);
    }
    return $retval;
}
$str1 = convBase($str1, '01', '0123456789ABCDEF');
$str2 = convBase($str2, '01', '0123456789ABCDEF');
$str3 = convBase($str3, '01', '0123456789ABCDEF');
$nulls1 = "";
if(strlen($str1) < 16) {
	for($j = 0; $j < (16 - strlen($str1)); $j++) {
		$nulls1 .= "0";
	}
}
$nulls2 = "";
if(strlen($str2) < 16) {
	for($j = 0; $j < (16 - strlen($str2)); $j++) {
		$nulls2 .= "0";
	}
}
$nulls3 = "";
if(strlen($str3) < 16) {
	for($j = 0; $j < (16 - strlen($str3)); $j++) {
		$nulls3 .= "0";
	}
}
$tr = "<p>Bitmap string: ".$nulls1.$str1."&nbsp;&nbsp;&nbsp;".$nulls2.$str2."&nbsp;&nbsp;&nbsp;".$nulls3.$str3."</p>";
}
?>
    <h1>ISO 8583 Bitmap Converter</h1>
	<?php echo $tr; ?>
    <form action="#" method="post">
    <div class="table table-1">
        <h2>First bitmap</h2>
        <table>
            <tbody>
                <tr>
                    <td><label id="bit0" name="bit0"><input id="inbit0" name="inbit0" type="checkbox"><span>Bit 001</span></label></td>
                    <td><label id="bit16" name="bit16"><input id="inbit16" name="inbit16" type="checkbox"><span>Bit 017</span></label></td>
                    <td><label id="bit32" name="bit32"><input id="inbit32" name="inbit32" type="checkbox"><span>Bit 033</span></label></td>
                    <td><label id="bit48" name="bit48"><input id="inbit48" name="inbit48" type="checkbox"><span>Bit 049</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit1" name="bit1"><input id="inbit1" name="inbit1" type="checkbox"><span>Bit 002</span></label></td>
                    <td><label id="bit17" name="bit17"><input id="inbit17" name="inbit17" type="checkbox"><span>Bit 018</span></label></td>
                    <td><label id="bit33" name="bit33"><input id="inbit33" name="inbit33" type="checkbox"><span>Bit 034</span></label></td>
                    <td><label id="bit49" name="bit49"><input id="inbit49" name="inbit49" type="checkbox"><span>Bit 050</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit2" name="bit2"><input id="inbit2" name="inbit2" type="checkbox"><span>Bit 003</span></label></td>
                    <td><label id="bit18" name="bit18"><input id="inbit18" name="inbit18" type="checkbox"><span>Bit 019</span></label></td>
                    <td><label id="bit34" name="bit34"><input id="inbit34" name="inbit34" type="checkbox"><span>Bit 035</span></label></td>
                    <td><label id="bit50" name="bit50"><input id="inbit50" name="inbit50" type="checkbox"><span>Bit 051</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit3" name="bit3"><input id="inbit3" name="inbit3" type="checkbox"><span>Bit 004</span></label></td>
                    <td><label id="bit19" name="bit19"><input id="inbit19" name="inbit19" type="checkbox"><span>Bit 020</span></label></td>
                    <td><label id="bit35" name="bit35"><input id="inbit35" name="inbit35" type="checkbox"><span>Bit 036</span></label></td>
                    <td><label id="bit51" name="bit51"><input id="inbit51" name="inbit51" type="checkbox"><span>Bit 052</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit4" name="bit4"><input id="inbit4" name="inbit4" type="checkbox"><span>Bit 005</span></label></td>
                    <td><label id="bit20" name="bit20"><input id="inbit20" name="inbit20" type="checkbox"><span>Bit 021</span></label></td>
                    <td><label id="bit36" name="bit36"><input id="inbit36" name="inbit36" type="checkbox"><span>Bit 037</span></label></td>
                    <td><label id="bit52" name="bit52"><input id="inbit52" name="inbit52" type="checkbox"><span>Bit 053</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit5" name="bit5"><input id="inbit5" name="inbit5" type="checkbox"><span>Bit 006</span></label></td>
                    <td><label id="bit21" name="bit21"><input id="inbit21" name="inbit21" type="checkbox"><span>Bit 022</span></label></td>
                    <td><label id="bit37" name="bit37"><input id="inbit37" name="inbit37" type="checkbox"><span>Bit 038</span></label></td>
                    <td><label id="bit53" name="bit53"><input id="inbit53" name="inbit53" type="checkbox"><span>Bit 054</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit6" name="bit6"><input id="inbit6" name="inbit6" type="checkbox"><span>Bit 007</span></label></td>
                    <td><label id="bit22" name="bit22"><input id="inbit22" name="inbit22" type="checkbox"><span>Bit 023</span></label></td>
                    <td><label id="bit38" name="bit38"><input id="inbit38" name="inbit38" type="checkbox"><span>Bit 039</span></label></td>
                    <td><label id="bit54" name="bit54"><input id="inbit54" name="inbit54" type="checkbox"><span>Bit 055</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit7" name="bit7"><input id="inbit7" name="inbit7" type="checkbox"><span>Bit 008</span></label></td>
                    <td><label id="bit23" name="bit23"><input id="inbit23" name="inbit23" type="checkbox"><span>Bit 024</span></label></td>
                    <td><label id="bit39" name="bit39"><input id="inbit39" name="inbit39" type="checkbox"><span>Bit 040</span></label></td>
                    <td><label id="bit55" name="bit55"><input id="inbit55" name="inbit55" type="checkbox"><span>Bit 056</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit8" name="bit8"><input id="inbit8" name="inbit8" type="checkbox"><span>Bit 009</span></label></td>
                    <td><label id="bit24" name="bit24"><input id="inbit24" name="inbit24" type="checkbox"><span>Bit 025</span></label></td>
                    <td><label id="bit40" name="bit40"><input id="inbit40" name="inbit40" type="checkbox"><span>Bit 041</span></label></td>
                    <td><label id="bit56" name="bit56"><input id="inbit56" name="inbit56" type="checkbox"><span>Bit 057</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit9" name="bit9"><input id="inbit9" name="inbit9" type="checkbox"><span>Bit 010</span></label></td>
                    <td><label id="bit25" name="bit25"><input id="inbit25" name="inbit25" type="checkbox"><span>Bit 026</span></label></td>
                    <td><label id="bit41" name="bit41"><input id="inbit41" name="inbit41" type="checkbox"><span>Bit 042</span></label></td>
                    <td><label id="bit57" name="bit57"><input id="inbit57" name="inbit57" type="checkbox"><span>Bit 058</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit10" name="bit10"><input id="inbit10" name="inbit10" type="checkbox"><span>Bit 011</span></label></td>
                    <td><label id="bit26" name="bit26"><input id="inbit26" name="inbit26" type="checkbox"><span>Bit 027</span></label></td>
                    <td><label id="bit42" name="bit42"><input id="inbit42" name="inbit42" type="checkbox"><span>Bit 043</span></label></td>
                    <td><label id="bit58" name="bit58"><input id="inbit58" name="inbit58" type="checkbox"><span>Bit 059</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit11" name="bit11"><input id="inbit11" name="inbit11" type="checkbox"><span>Bit 012</span></label></td>
                    <td><label id="bit27" name="bit27"><input id="inbit27" name="inbit27" type="checkbox"><span>Bit 028</span></label></td>
                    <td><label id="bit43" name="bit43"><input id="inbit43" name="inbit43" type="checkbox"><span>Bit 044</span></label></td>
                    <td><label id="bit59" name="bit59"><input id="inbit59" name="inbit59" type="checkbox"><span>Bit 060</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit12" name="bit12"><input id="inbit12" name="inbit12" type="checkbox"><span>Bit 013</span></label></td>
                    <td><label id="bit28" name="bit28"><input id="inbit28" name="inbit28" type="checkbox"><span>Bit 029</span></label></td>
                    <td><label id="bit44" name="bit44"><input id="inbit44" name="inbit44" type="checkbox"><span>Bit 045</span></label></td>
                    <td><label id="bit60" name="bit60"><input id="inbit60" name="inbit60" type="checkbox"><span>Bit 061</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit13" name="bit13"><input id="inbit13" name="inbit13" type="checkbox"><span>Bit 014</span></label></td>
                    <td><label id="bit29" name="bit29"><input id="inbit29" name="inbit29" type="checkbox"><span>Bit 030</span></label></td>
                    <td><label id="bit45" name="bit45"><input id="inbit45" name="inbit45" type="checkbox"><span>Bit 046</span></label></td>
                    <td><label id="bit61" name="bit61"><input id="inbit61" name="inbit61" type="checkbox"><span>Bit 062</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit14" name="bit14"><input id="inbit14" name="inbit14" type="checkbox"><span>Bit 015</span></label></td>
                    <td><label id="bit30" name="bit30"><input id="inbit30" name="inbit30" type="checkbox"><span>Bit 031</span></label></td>
                    <td><label id="bit46" name="bit46"><input id="inbit46" name="inbit46" type="checkbox"><span>Bit 047</span></label></td>
                    <td><label id="bit62" name="bit62"><input id="inbit62" name="inbit62" type="checkbox"><span>Bit 063</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit15" name="bit15"><input id="inbit15" name="inbit15" type="checkbox"><span>Bit 016</span></label></td>
                    <td><label id="bit31" name="bit31"><input id="inbit31" name="inbit31" type="checkbox"><span>Bit 032</span></label></td>
                    <td><label id="bit47" name="bit47"><input id="inbit47" name="inbit47" type="checkbox"><span>Bit 048</span></label></td>
                    <td><label id="bit63" name="bit63"><input id="inbit63" name="inbit63" type="checkbox"><span>Bit 064</span></label></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table table-2">
        <h2>Second bitmap</h2>
        <table>
            <tbody>
                <tr>
                    <td><label id="bit64" name="bit64"><input id="inbit64" name="inbit64" type="checkbox"><span>Bit 065</span></label></td>
                    <td><label id="bit80" name="bit80"><input id="inbit80" name="inbit80" type="checkbox"><span>Bit 081</span></label></td>
                    <td><label id="bit96" name="bit96"><input id="inbit96" name="inbit96" type="checkbox"><span>Bit 097</span></label></td>
                    <td><label id="bit112" name="bit112"><input id="inbit112" name="inbit112" type="checkbox"><span>Bit 113</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit65" name="bit65"><input id="inbit65" name="inbit65" type="checkbox"><span>Bit 066</span></label></td>
                    <td><label id="bit81" name="bit81"><input id="inbit81" name="inbit81" type="checkbox"><span>Bit 082</span></label></td>
                    <td><label id="bit97" name="bit97"><input id="inbit97" name="inbit97" type="checkbox"><span>Bit 098</span></label></td>
                    <td><label id="bit113" name="bit113"><input id="inbit113" name="inbit113" type="checkbox"><span>Bit 114</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit66" name="bit66"><input id="inbit66" name="inbit66" type="checkbox"><span>Bit 067</span></label></td>
                    <td><label id="bit82" name="bit82"><input id="inbit82" name="inbit82" type="checkbox"><span>Bit 083</span></label></td>
                    <td><label id="bit98" name="bit98"><input id="inbit98" name="inbit98" type="checkbox"><span>Bit 099</span></label></td>
                    <td><label id="bit114" name="bit114"><input id="inbit114" name="inbit114" type="checkbox"><span>Bit 115</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit67" name="bit67"><input id="inbit67" name="inbit67" type="checkbox"><span>Bit 068</span></label></td>
                    <td><label id="bit83" name="bit83"><input id="inbit83" name="inbit83" type="checkbox"><span>Bit 084</span></label></td>
                    <td><label id="bit99" name="bit99"><input id="inbit99" name="inbit99" type="checkbox"><span>Bit 100</span></label></td>
                    <td><label id="bit115" name="bit115"><input id="inbit115" name="inbit115" type="checkbox"><span>Bit 116</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit68" name="bit68"><input id="inbit68" name="inbit68" type="checkbox"><span>Bit 069</span></label></td>
                    <td><label id="bit84" name="bit84"><input id="inbit84" name="inbit84" type="checkbox"><span>Bit 085</span></label></td>
                    <td><label id="bit100" name="bit100"><input id="inbit100" name="inbit100" type="checkbox"><span>Bit 101</span></label></td>
                    <td><label id="bit116" name="bit116"><input id="inbit116" name="inbit116" type="checkbox"><span>Bit 117</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit69" name="bit69"><input id="inbit69" name="inbit69" type="checkbox"><span>Bit 070</span></label></td>
                    <td><label id="bit85" name="bit85"><input id="inbit85" name="inbit85" type="checkbox"><span>Bit 086</span></label></td>
                    <td><label id="bit101" name="bit101"><input id="inbit101" name="inbit101" type="checkbox"><span>Bit 102</span></label></td>
                    <td><label id="bit117" name="bit117"><input id="inbit117" name="inbit117" type="checkbox"><span>Bit 118</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit70" name="bit70"><input id="inbit70" name="inbit70" type="checkbox"><span>Bit 071</span></label></td>
                    <td><label id="bit86" name="bit86"><input id="inbit86" name="inbit86" type="checkbox"><span>Bit 087</span></label></td>
                    <td><label id="bit102" name="bit102"><input id="inbit102" name="inbit102" type="checkbox"><span>Bit 103</span></label></td>
                    <td><label id="bit118" name="bit118"><input id="inbit118" name="inbit118" type="checkbox"><span>Bit 119</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit71" name="bit71"><input id="inbit71" name="inbit71" type="checkbox"><span>Bit 072</span></label></td>
                    <td><label id="bit87" name="bit87"><input id="inbit87" name="inbit87" type="checkbox"><span>Bit 088</span></label></td>
                    <td><label id="bit103" name="bit103"><input id="inbit103" name="inbit103" type="checkbox"><span>Bit 104</span></label></td>
                    <td><label id="bit119" name="bit119"><input id="inbit119" name="inbit119" type="checkbox"><span>Bit 120</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit72" name="bit72"><input id="inbit72" name="inbit72" type="checkbox"><span>Bit 073</span></label></td>
                    <td><label id="bit88" name="bit88"><input id="inbit88" name="inbit88" type="checkbox"><span>Bit 089</span></label></td>
                    <td><label id="bit104" name="bit104"><input id="inbit104" name="inbit104" type="checkbox"><span>Bit 105</span></label></td>
                    <td><label id="bit120" name="bit120"><input id="inbit120" name="inbit120" type="checkbox"><span>Bit 121</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit73" name="bit73"><input id="inbit73" name="inbit73" type="checkbox"><span>Bit 074</span></label></td>
                    <td><label id="bit89" name="bit89"><input id="inbit89" name="inbit89" type="checkbox"><span>Bit 090</span></label></td>
                    <td><label id="bit105" name="bit105"><input id="inbit105" name="inbit105" type="checkbox"><span>Bit 106</span></label></td>
                    <td><label id="bit121" name="bit121"><input id="inbit121" name="inbit121" type="checkbox"><span>Bit 122</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit74" name="bit74"><input id="inbit74" name="inbit74" type="checkbox"><span>Bit 075</span></label></td>
                    <td><label id="bit90" name="bit90"><input id="inbit90" name="inbit90" type="checkbox"><span>Bit 091</span></label></td>
                    <td><label id="bit106" name="bit106"><input id="inbit106" name="inbit106" type="checkbox"><span>Bit 107</span></label></td>
                    <td><label id="bit122" name="bit122"><input id="inbit122" name="inbit122" type="checkbox"><span>Bit 123</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit75" name="bit75"><input id="inbit75" name="inbit75" type="checkbox"><span>Bit 076</span></label></td>
                    <td><label id="bit91" name="bit91"><input id="inbit91" name="inbit91" type="checkbox"><span>Bit 092</span></label></td>
                    <td><label id="bit107" name="bit107"><input id="inbit107" name="inbit107" type="checkbox"><span>Bit 108</span></label></td>
                    <td><label id="bit123" name="bit123"><input id="inbit123" name="inbit123" type="checkbox"><span>Bit 124</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit76" name="bit76"><input id="inbit76" name="inbit76" type="checkbox"><span>Bit 077</span></label></td>
                    <td><label id="bit92" name="bit92"><input id="inbit92" name="inbit92" type="checkbox"><span>Bit 093</span></label></td>
                    <td><label id="bit108" name="bit108"><input id="inbit108" name="inbit108" type="checkbox"><span>Bit 109</span></label></td>
                    <td><label id="bit124" name="bit124"><input id="inbit124" name="inbit124" type="checkbox"><span>Bit 125</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit77" name="bit77"><input id="inbit77" name="inbit77" type="checkbox"><span>Bit 078</span></label></td>
                    <td><label id="bit93" name="bit93"><input id="inbit93" name="inbit93" type="checkbox"><span>Bit 094</span></label></td>
                    <td><label id="bit109" name="bit109"><input id="inbit109" name="inbit109" type="checkbox"><span>Bit 110</span></label></td>
                    <td><label id="bit125" name="bit125"><input id="inbit125" name="inbit125" type="checkbox"><span>Bit 126</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit78" name="bit78"><input id="inbit78" name="inbit78" type="checkbox"><span>Bit 079</span></label></td>
                    <td><label id="bit94" name="bit94"><input id="inbit94" name="inbit94" type="checkbox"><span>Bit 095</span></label></td>
                    <td><label id="bit110" name="bit110"><input id="inbit110" name="inbit110" type="checkbox"><span>Bit 111</span></label></td>
                    <td><label id="bit126" name="bit126"><input id="inbit126" name="inbit126" type="checkbox"><span>Bit 127</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit79" name="bit79"><input id="inbit79" name="inbit79" type="checkbox"><span>Bit 080</span></label></td>
                    <td><label id="bit95" name="bit95"><input id="inbit95" name="inbit95" type="checkbox"><span>Bit 096</span></label></td>
                    <td><label id="bit111" name="bit111"><input id="inbit111" name="inbit111" type="checkbox"><span>Bit 112</span></label></td>
                    <td><label id="bit127" name="bit127"><input id="inbit127" name="inbit127" type="checkbox"><span>Bit 128</span></label></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table table-3">
        <h2>Third bitmap</h2>
        <table>
            <tbody>
                <tr>
                    <td><label id="bit128" name="bit128"><input id="inbit128" name="inbit128" type="checkbox"><span>Bit 129</span></label></td>
                    <td><label id="bit144" name="bit144"><input id="inbit144" name="inbit144" type="checkbox"><span>Bit 145</span></label></td>
                    <td><label id="bit160" name="bit160"><input id="inbit160" name="inbit160" type="checkbox"><span>Bit 161</span></label></td>
                    <td><label id="bit176" name="bit176"><input id="inbit176" name="inbit176" type="checkbox"><span>Bit 177</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit129" name="bit129"><input id="inbit129" name="inbit129" type="checkbox"><span>Bit 130</span></label></td>
                    <td><label id="bit145" name="bit145"><input id="inbit145" name="inbit145" type="checkbox"><span>Bit 146</span></label></td>
                    <td><label id="bit161" name="bit161"><input id="inbit161" name="inbit161" type="checkbox"><span>Bit 162</span></label></td>
                    <td><label id="bit177" name="bit177"><input id="inbit177" name="inbit177" type="checkbox"><span>Bit 178</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit130" name="bit130"><input id="inbit130" name="inbit130" type="checkbox"><span>Bit 131</span></label></td>
                    <td><label id="bit146" name="bit146"><input id="inbit146" name="inbit146" type="checkbox"><span>Bit 147</span></label></td>
                    <td><label id="bit162" name="bit162"><input id="inbit162" name="inbit162" type="checkbox"><span>Bit 163</span></label></td>
                    <td><label id="bit178" name="bit178"><input id="inbit178" name="inbit178" type="checkbox"><span>Bit 179</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit131" name="bit131"><input id="inbit131" name="inbit131" type="checkbox"><span>Bit 132</span></label></td>
                    <td><label id="bit147" name="bit147"><input id="inbit147" name="inbit147" type="checkbox"><span>Bit 148</span></label></td>
                    <td><label id="bit163" name="bit163"><input id="inbit163" name="inbit163" type="checkbox"><span>Bit 164</span></label></td>
                    <td><label id="bit179" name="bit179"><input id="inbit179" name="inbit179" type="checkbox"><span>Bit 180</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit132" name="bit132"><input id="inbit132" name="inbit132" type="checkbox"><span>Bit 133</span></label></td>
                    <td><label id="bit148" name="bit148"><input id="inbit148" name="inbit148" type="checkbox"><span>Bit 149</span></label></td>
                    <td><label id="bit164" name="bit164"><input id="inbit164" name="inbit164" type="checkbox"><span>Bit 165</span></label></td>
                    <td><label id="bit180" name="bit180"><input id="inbit180" name="inbit180" type="checkbox"><span>Bit 181</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit133" name="bit133"><input id="inbit133" name="inbit133" type="checkbox"><span>Bit 134</span></label></td>
                    <td><label id="bit149" name="bit149"><input id="inbit149" name="inbit149" type="checkbox"><span>Bit 150</span></label></td>
                    <td><label id="bit165" name="bit165"><input id="inbit165" name="inbit165" type="checkbox"><span>Bit 166</span></label></td>
                    <td><label id="bit181" name="bit181"><input id="inbit181" name="inbit181" type="checkbox"><span>Bit 182</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit134" name="bit134"><input id="inbit134" name="inbit134" type="checkbox"><span>Bit 135</span></label></td>
                    <td><label id="bit150" name="bit150"><input id="inbit150" name="inbit150" type="checkbox"><span>Bit 151</span></label></td>
                    <td><label id="bit166" name="bit166"><input id="inbit166" name="inbit166" type="checkbox"><span>Bit 167</span></label></td>
                    <td><label id="bit182" name="bit182"><input id="inbit182" name="inbit182" type="checkbox"><span>Bit 183</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit135" name="bit135"><input id="inbit135" name="inbit135" type="checkbox"><span>Bit 136</span></label></td>
                    <td><label id="bit151" name="bit151"><input id="inbit151" name="inbit151" type="checkbox"><span>Bit 152</span></label></td>
                    <td><label id="bit167" name="bit167"><input id="inbit167" name="inbit167" type="checkbox"><span>Bit 168</span></label></td>
                    <td><label id="bit183" name="bit183"><input id="inbit183" name="inbit183" type="checkbox"><span>Bit 184</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit136" name="bit136"><input id="inbit136" name="inbit136" type="checkbox"><span>Bit 137</span></label></td>
                    <td><label id="bit152" name="bit152"><input id="inbit152" name="inbit152" type="checkbox"><span>Bit 153</span></label></td>
                    <td><label id="bit168" name="bit168"><input id="inbit168" name="inbit168" type="checkbox"><span>Bit 169</span></label></td>
                    <td><label id="bit184" name="bit184"><input id="inbit184" name="inbit184" type="checkbox"><span>Bit 185</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit137" name="bit137"><input id="inbit137" name="inbit137" type="checkbox"><span>Bit 138</span></label></td>
                    <td><label id="bit153" name="bit153"><input id="inbit153" name="inbit153" type="checkbox"><span>Bit 154</span></label></td>
                    <td><label id="bit169" name="bit169"><input id="inbit169" name="inbit169" type="checkbox"><span>Bit 170</span></label></td>
                    <td><label id="bit185" name="bit185"><input id="inbit185" name="inbit185" type="checkbox"><span>Bit 186</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit138" name="bit138"><input id="inbit138" name="inbit138" type="checkbox"><span>Bit 139</span></label></td>
                    <td><label id="bit154" name="bit154"><input id="inbit154" name="inbit154" type="checkbox"><span>Bit 155</span></label></td>
                    <td><label id="bit170" name="bit170"><input id="inbit170" name="inbit170" type="checkbox"><span>Bit 171</span></label></td>
                    <td><label id="bit186" name="bit186"><input id="inbit186" name="inbit186" type="checkbox"><span>Bit 187</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit139" name="bit139"><input id="inbit139" name="inbit139" type="checkbox"><span>Bit 140</span></label></td>
                    <td><label id="bit155" name="bit155"><input id="inbit155" name="inbit155" type="checkbox"><span>Bit 156</span></label></td>
                    <td><label id="bit171" name="bit171"><input id="inbit171" name="inbit171" type="checkbox"><span>Bit 172</span></label></td>
                    <td><label id="bit187" name="bit187"><input id="inbit187" name="inbit187" type="checkbox"><span>Bit 188</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit140" name="bit140"><input id="inbit140" name="inbit140" type="checkbox"><span>Bit 141</span></label></td>
                    <td><label id="bit156" name="bit156"><input id="inbit156" name="inbit156" type="checkbox"><span>Bit 157</span></label></td>
                    <td><label id="bit172" name="bit172"><input id="inbit172" name="inbit172" type="checkbox"><span>Bit 173</span></label></td>
                    <td><label id="bit188" name="bit188"><input id="inbit188" name="inbit188" type="checkbox"><span>Bit 189</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit141" name="bit141"><input id="inbit141" name="inbit141" type="checkbox"><span>Bit 142</span></label></td>
                    <td><label id="bit157" name="bit157"><input id="inbit157" name="inbit157" type="checkbox"><span>Bit 158</span></label></td>
                    <td><label id="bit173" name="bit173"><input id="inbit173" name="inbit173" type="checkbox"><span>Bit 174</span></label></td>
                    <td><label id="bit189" name="bit189"><input id="inbit189" name="inbit189" type="checkbox"><span>Bit 190</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit142" name="bit142"><input id="inbit142" name="inbit142" type="checkbox"><span>Bit 143</span></label></td>
                    <td><label id="bit158" name="bit158"><input id="inbit158" name="inbit158" type="checkbox"><span>Bit 159</span></label></td>
                    <td><label id="bit174" name="bit174"><input id="inbit174" name="inbit174" type="checkbox"><span>Bit 175</span></label></td>
                    <td><label id="bit190" name="bit190"><input id="inbit190" name="inbit190" type="checkbox"><span>Bit 191</span></label></td>
                </tr>
                <tr>
                    <td><label id="bit143" name="bit143"><input id="inbit143" name="inbit143" type="checkbox"><span>Bit 144</span></label></td>
                    <td><label id="bit159" name="bit159"><input id="inbit159" name="inbit159" type="checkbox"><span>Bit 160</span></label></td>
                    <td><label id="bit175" name="bit175"><input id="inbit175" name="inbit175" type="checkbox"><span>Bit 176</span></label></td>
                    <td><label id="bit191" name="bit191"><input id="inbit191" name="inbit191" type="checkbox"><span>Bit 192</span></label></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="sb-btn">
        <input type="submit" name="submitBtn" value="Submit">
        <span>Options:</span>
        <input type="checkbox" onclick="toggle(this);" />Check all
    </div>
</form>
</body>
<script>
    function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
</html>