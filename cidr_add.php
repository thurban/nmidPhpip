<?php
/*
+-------------------------------------------------------------------------+
| Copyright (C) 2006 Michael Earls                                        |
|                                                                         |
| This program is free software; you can redistribute it and/or           |
| modify it under the terms of the GNU General Public License             |
| as published by the Free Software Foundation; either version 2          |
| of the License, or (at your option) any later version.                  |
|                                                                         |
| This program is distributed in the hope that it will be useful,         |
| but WITHOUT ANY WARRANTY; without even the implied warranty of          |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the           |
| GNU General Public License for more details.                            |
+-------------------------------------------------------------------------+
| - phpIP - http://www.phpip.net/                                         |
+-------------------------------------------------------------------------+
*/

require('Net/IPv4.php');

$dir = dirname(__FILE__);
if ( stristr( PHP_OS, 'WIN' ) ) {
    // Windows
    $mainDir = preg_replace("/plugins\\nmidPhpip/","",$dir);
} else {
    // Other Os 
    $mainDir = preg_replace("/plugins\/nmidPhpip/","",$dir);
}
chdir($mainDir);	

include("./include/auth.php");
//include_once($config["library_path"] . "/data_query.php");
include("./include/top_header.php");

if (isset ($_REQUEST["ipcidr"])) { $ipcidr = strip_tags($_REQUEST["ipcidr"]); }
if (isset ($_REQUEST["CidrNet"])) { $CidrNet = strip_tags($_REQUEST["CidrNet"]); }
if (isset ($_REQUEST["ip0"])) { $ip0 = strip_tags($_REQUEST["ip0"]); }
if (isset ($_REQUEST["ip1"])) { $ip1 = strip_tags($_REQUEST["ip1"]); }
if (isset ($_REQUEST["ip2"])) { $ip2 = strip_tags($_REQUEST["ip2"]); }
if (isset ($_REQUEST["ip3"])) { $ip3 = strip_tags($_REQUEST["ip3"]); }


ob_start();

// Use the myheader function from layout.php
myheader("CIDR ADD");

$switchVar = 'nothingSet';

if ( isset ($_REQUEST["mode"]) )
{
	$switchVar = $_REQUEST["mode"];
}
switch ($switchVar) {

case "ci":
{

?>
<h2><font color="FF0000">Updating Database, Please wait</font></h2>

<?php

/*
/ Cidr and prefix inserts, parse cidr
*/

$cidr = $ip0.'.'.$ip1.'.'.$ip2.'.'.$ip3.'/'.$CidrNet;

  $NetMenuSql = mysql_query("INSERT INTO `phpIP_NetMenu` ( `NetMenuCidr` , `NetCidrDescription` ) 
	VALUES ('$cidr', '$ipcidr')");
  $id = mysql_insert_id();

$net = Net_IPv4::parseAddress($cidr);

$n = explode(".", $net->network); // parse for network address
$b = explode(".", $net->broadcast); // parse for broadcast address

if ($CidrNet > '24') {
	// Greater then 24
        // for loop to build fourth octets
        $NetPrefixSql = mysql_query("INSERT INTO `phpIP_net_ips` (`netaddress` , `NetCidr`) VALUES ('$n[0].$n[1].$n[2].$n[3]', '$id')");
                for ($f = $n[3]; $f <= "$b[3]"; $f++)
                {
                $insertIP = mysql_query("INSERT INTO `phpIP_addresses` (`ip`, `NetID`) VALUES ('$n[0].$n[1].$n[2].$f', '$id')");
                } // end for loop
} else {
        	// Less then 24
                // for loop to build third octects
                for ($f = $n[1]; $f <= "$b[1]"; $f++)
                for ($e = $n[2]; $e <= "$b[2]"; $e++)
                {
                $NetPrefixSql = mysql_query("INSERT INTO `phpIP_net_ips` (`netaddress` , `NetCidr`) VALUES ('$n[0].$f.$e', '$id')");
                } // end for loop
} // end if else
?>



<meta http-equiv=Refresh content=1;url="<?php echo $config['url_path'];?>plugins/nmidPhpip/prefix_add.php?mode=parse&cidr=<?php echo $cidr;?>&di=<?php echo $id;?>">

<?php

} // end case
break;


default:

?>

<FORM action="cidr_add.php" method=get name="ipadd">
<input type=hidden name=mode value=ci>
<table class="listTable" style="width:100%" cellpadding="0" cellspacing="0">
  <tr class="listCell">
   <TD class="listCell">CLASSLESS INTERDOMAIN ROUTING (CIDR)</span></TD>
  </tr>
  <tr class="listHeadRow">
   <TD class="listCell">ADD <a href="http://www.vermeer.org/cidr.php" target="_blank"><font color="white">[CIDR Chart]</font></a></TD>

  </tr>
    <tr class="listRow2">
     <TD class="listCell">
  <select size="1" name="ip0">
	<option>1</option>
	<option>2</option>

	<option>3</option>
	<option>4</option>
	<option>5</option>
	<option>6</option>
	<option>7</option>
	<option>8</option>

	<option>9</option>
	<option>10</option>
	<option>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>

	<option>15</option>
	<option>16</option>
	<option>17</option>
	<option>18</option>
	<option>19</option>
	<option>20</option>

	<option>21</option>
	<option>22</option>
	<option>23</option>
	<option>24</option>
	<option>25</option>
	<option>26</option>

	<option>27</option>
	<option>28</option>
	<option>29</option>
	<option>30</option>
	<option>31</option>
	<option>32</option>

	<option>33</option>
	<option>34</option>
	<option>35</option>
	<option>36</option>
	<option>37</option>
	<option>38</option>

	<option>39</option>
	<option>40</option>
	<option>41</option>
	<option>42</option>
	<option>43</option>
	<option>44</option>

	<option>45</option>
	<option>46</option>
	<option>47</option>
	<option>48</option>
	<option>49</option>
	<option>50</option>

	<option>51</option>
	<option>52</option>
	<option>53</option>
	<option>54</option>
	<option>55</option>
	<option>56</option>

	<option>57</option>
	<option>58</option>
	<option>59</option>
	<option>60</option>
	<option>61</option>
	<option>62</option>

	<option>63</option>
	<option>64</option>
	<option>65</option>
	<option>66</option>
	<option>67</option>
	<option>68</option>

	<option>69</option>
	<option>70</option>
	<option>71</option>
	<option>72</option>
	<option>73</option>
	<option>74</option>

	<option>75</option>
	<option>76</option>
	<option>77</option>
	<option>78</option>
	<option>79</option>
	<option>80</option>

	<option>81</option>
	<option>82</option>
	<option>83</option>
	<option>84</option>
	<option>85</option>
	<option>86</option>

	<option>87</option>
	<option>88</option>
	<option>89</option>
	<option>90</option>
	<option>91</option>
	<option>92</option>

	<option>93</option>
	<option>94</option>
	<option>95</option>
	<option>96</option>
	<option>97</option>
	<option>98</option>

	<option>99</option>
	<option>100</option>
	<option>101</option>
	<option>102</option>
	<option>103</option>
	<option>104</option>

	<option>105</option>
	<option>106</option>
	<option>107</option>
	<option>108</option>
	<option>109</option>
	<option>110</option>

	<option>111</option>
	<option>112</option>
	<option>113</option>
	<option>114</option>
	<option>115</option>
	<option>116</option>

	<option>117</option>
	<option>118</option>
	<option>119</option>
	<option>120</option>
	<option>121</option>
	<option>122</option>

	<option>123</option>
	<option>124</option>
	<option>125</option>
	<option>126</option>
	<option>127</option>
	<option>128</option>

	<option>129</option>
	<option>130</option>
	<option>131</option>
	<option>132</option>
	<option>133</option>
	<option>134</option>

	<option>135</option>
	<option>136</option>
	<option>137</option>
	<option>138</option>
	<option>139</option>
	<option>140</option>

	<option>141</option>
	<option>142</option>
	<option>143</option>
	<option>144</option>
	<option>145</option>
	<option>146</option>

	<option>147</option>
	<option>148</option>
	<option>149</option>
	<option>150</option>
	<option>151</option>
	<option>152</option>

	<option>153</option>
	<option>154</option>
	<option>155</option>
	<option>156</option>
	<option>157</option>
	<option>158</option>

	<option>159</option>
	<option>160</option>
	<option>161</option>
	<option>162</option>
	<option>163</option>
	<option>164</option>

	<option>165</option>
	<option>166</option>	
	<option>167</option>
	<option>168</option>
	<option>169</option>
	<option>170</option>

	<option>171</option>
	<option>172</option>
	<option>173</option>
	<option>174</option>
	<option>175</option>
	<option>176</option>

	<option>177</option>
	<option>178</option>
	<option>179</option>
	<option>180</option>
	<option>181</option>
	<option>182</option>

	<option>183</option>
	<option>184</option>
	<option>185</option>
	<option>186</option>
	<option>187</option>
	<option>188</option>

	<option>189</option>
	<option>190</option>
	<option>191</option>
	<option>192</option>
	<option>193</option>
	<option>194</option>

	<option>195</option>
	<option>196</option>
	<option>197</option>
	<option>198</option>
	<option>199</option>
	<option>200</option>

	<option>201</option>
	<option>202</option>
	<option>203</option>
	<option>204</option>
	<option>205</option>
	<option>206</option>

	<option>207</option>
	<option>208</option>
	<option>209</option>
	<option>210</option>
	<option>211</option>
	<option>212</option>

	<option>213</option>
	<option>214</option>
	<option>215</option>
	<option>216</option>
	<option>217</option>
	<option>218</option>

	<option>219</option>
	<option>220</option>
	<option>221</option>
	<option>222</option>
	<option>223</option>
	<option>224</option>

	<option>225</option>
	<option>226</option>
	<option>227</option>
	<option>228</option>
	<option>229</option>
	<option>230</option>

	<option>231</option>
	<option>232</option>
	<option>233</option>
	<option>234</option>
	<option>235</option>
	<option>236</option>

	<option>237</option>
	<option>238</option>
	<option>239</option>
	<option>240</option>
	<option>241</option>
	<option>242</option>

	<option>243</option>
	<option>244</option>
	<option>245</option>
	<option>246</option>
	<option>247</option>
	<option>248</option>

	<option>249</option>
	<option>250</option>
	<option>251</option>
	<option>252</option>
	<option>253</option>
	<option>254</option>

	<option>255</option>
  </select>&nbsp;<b><font size=+1 color="000000">.</font></b>&nbsp;<select size="1" name="ip1">
	<option>0</option>
	<option>1</option>
	<option>2</option>
	<option>3</option>

	<option>4</option>
	<option>5</option>
	<option>6</option>
	<option>7</option>
	<option>8</option>
	<option>9</option>

	<option>10</option>
	<option>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>
	<option>15</option>

	<option>16</option>
	<option>17</option>
	<option>18</option>
	<option>19</option>
	<option>20</option>
	<option>21</option>

	<option>22</option>
	<option>23</option>
	<option>24</option>
	<option>25</option>
	<option>26</option>
	<option>27</option>

	<option>28</option>
	<option>29</option>
	<option>30</option>
	<option>31</option>
	<option>32</option>
	<option>33</option>

	<option>34</option>
	<option>35</option>
	<option>36</option>
	<option>37</option>
	<option>38</option>
	<option>39</option>

	<option>40</option>
	<option>41</option>
	<option>42</option>
	<option>43</option>
	<option>44</option>
	<option>45</option>

	<option>46</option>
	<option>47</option>
	<option>48</option>
	<option>49</option>
	<option>50</option>
	<option>51</option>

	<option>52</option>
	<option>53</option>
	<option>54</option>
	<option>55</option>
	<option>56</option>
	<option>57</option>

	<option>58</option>
	<option>59</option>
	<option>60</option>
	<option>61</option>
	<option>62</option>
	<option>63</option>

	<option>64</option>
	<option>65</option>
	<option>66</option>
	<option>67</option>
	<option>68</option>
	<option>69</option>

	<option>70</option>
	<option>71</option>
	<option>72</option>
	<option>73</option>
	<option>74</option>
	<option>75</option>

	<option>76</option>
	<option>77</option>
	<option>78</option>
	<option>79</option>
	<option>80</option>
	<option>81</option>

	<option>82</option>
	<option>83</option>
	<option>84</option>
	<option>85</option>
	<option>86</option>
	<option>87</option>

	<option>88</option>
	<option>89</option>
	<option>90</option>
	<option>91</option>
	<option>92</option>
	<option>93</option>

	<option>94</option>
	<option>95</option>
	<option>96</option>
	<option>97</option>
	<option>98</option>
	<option>99</option>

	<option>100</option>
	<option>101</option>
	<option>102</option>
	<option>103</option>
	<option>104</option>
	<option>105</option>

	<option>106</option>
	<option>107</option>
	<option>108</option>
	<option>109</option>
	<option>110</option>
	<option>111</option>

	<option>112</option>
	<option>113</option>
	<option>114</option>
	<option>115</option>
	<option>116</option>
	<option>117</option>

	<option>118</option>
	<option>119</option>
	<option>120</option>
	<option>121</option>
	<option>122</option>
	<option>123</option>

	<option>124</option>
	<option>125</option>
	<option>126</option>
	<option>127</option>
	<option>128</option>
	<option>129</option>

	<option>130</option>
	<option>131</option>
	<option>132</option>
	<option>133</option>
	<option>134</option>
	<option>135</option>

	<option>136</option>
	<option>137</option>
	<option>138</option>
	<option>139</option>
	<option>140</option>
	<option>141</option>

	<option>142</option>
	<option>143</option>
	<option>144</option>
	<option>145</option>
	<option>146</option>
	<option>147</option>

	<option>148</option>
	<option>149</option>
	<option>150</option>
	<option>151</option>
	<option>152</option>
	<option>153</option>

	<option>154</option>
	<option>155</option>
	<option>156</option>
	<option>157</option>
	<option>158</option>
	<option>159</option>

	<option>160</option>
	<option>161</option>
	<option>162</option>
	<option>163</option>
	<option>164</option>
	<option>165</option>

	<option>166</option>	
	<option>167</option>
	<option>168</option>
	<option>169</option>
	<option>170</option>
	<option>171</option>

	<option>172</option>
	<option>173</option>
	<option>174</option>
	<option>175</option>
	<option>176</option>
	<option>177</option>

	<option>178</option>
	<option>179</option>
	<option>180</option>
	<option>181</option>
	<option>182</option>
	<option>183</option>

	<option>184</option>
	<option>185</option>
	<option>186</option>
	<option>187</option>
	<option>188</option>
	<option>189</option>

	<option>190</option>
	<option>191</option>
	<option>192</option>
	<option>193</option>
	<option>194</option>
	<option>195</option>

	<option>196</option>
	<option>197</option>
	<option>198</option>
	<option>199</option>
	<option>200</option>
	<option>201</option>

	<option>202</option>
	<option>203</option>
	<option>204</option>
	<option>205</option>
	<option>206</option>
	<option>207</option>

	<option>208</option>
	<option>209</option>
	<option>210</option>
	<option>211</option>
	<option>212</option>
	<option>213</option>

	<option>214</option>
	<option>215</option>
	<option>216</option>
	<option>217</option>
	<option>218</option>
	<option>219</option>

	<option>220</option>
	<option>221</option>
	<option>222</option>
	<option>223</option>
	<option>224</option>
	<option>225</option>

	<option>226</option>
	<option>227</option>
	<option>228</option>
	<option>229</option>
	<option>230</option>
	<option>231</option>

	<option>232</option>
	<option>233</option>
	<option>234</option>
	<option>235</option>
	<option>236</option>
	<option>237</option>

	<option>238</option>
	<option>239</option>
	<option>240</option>
	<option>241</option>
	<option>242</option>
	<option>243</option>

	<option>244</option>
	<option>245</option>
	<option>246</option>
	<option>247</option>
	<option>248</option>
	<option>249</option>

	<option>250</option>
	<option>251</option>
	<option>252</option>
	<option>253</option>
	<option>254</option>
	<option>255</option>

  </select>&nbsp;<b><font size=+1 color="000000">.</b></font>&nbsp;
    <select size="1" name="ip2">
	<option>0</option>
	<option>1</option>
	<option>2</option>
	<option>3</option>

	<option>4</option>
	<option>5</option>
	<option>6</option>
	<option>7</option>
	<option>8</option>
	<option>9</option>

	<option>10</option>
	<option>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>
	<option>15</option>

	<option>16</option>
	<option>17</option>
	<option>18</option>
	<option>19</option>
	<option>20</option>
	<option>21</option>

	<option>22</option>
	<option>23</option>
	<option>24</option>
	<option>25</option>
	<option>26</option>
	<option>27</option>

	<option>28</option>
	<option>29</option>
	<option>30</option>
	<option>31</option>
	<option>32</option>
	<option>33</option>

	<option>34</option>
	<option>35</option>
	<option>36</option>
	<option>37</option>
	<option>38</option>
	<option>39</option>

	<option>40</option>
	<option>41</option>
	<option>42</option>
	<option>43</option>
	<option>44</option>
	<option>45</option>

	<option>46</option>
	<option>47</option>
	<option>48</option>
	<option>49</option>
	<option>50</option>
	<option>51</option>

	<option>52</option>
	<option>53</option>
	<option>54</option>
	<option>55</option>
	<option>56</option>
	<option>57</option>

	<option>58</option>
	<option>59</option>
	<option>60</option>
	<option>61</option>
	<option>62</option>
	<option>63</option>

	<option>64</option>
	<option>65</option>
	<option>66</option>
	<option>67</option>
	<option>68</option>
	<option>69</option>

	<option>70</option>
	<option>71</option>
	<option>72</option>
	<option>73</option>
	<option>74</option>
	<option>75</option>

	<option>76</option>
	<option>77</option>
	<option>78</option>
	<option>79</option>
	<option>80</option>
	<option>81</option>

	<option>82</option>
	<option>83</option>
	<option>84</option>
	<option>85</option>
	<option>86</option>
	<option>87</option>

	<option>88</option>
	<option>89</option>
	<option>90</option>
	<option>91</option>
	<option>92</option>
	<option>93</option>

	<option>94</option>
	<option>95</option>
	<option>96</option>
	<option>97</option>
	<option>98</option>
	<option>99</option>

	<option>100</option>
	<option>101</option>
	<option>102</option>
	<option>103</option>
	<option>104</option>
	<option>105</option>

	<option>106</option>
	<option>107</option>
	<option>108</option>
	<option>109</option>
	<option>110</option>
	<option>111</option>

	<option>112</option>
	<option>113</option>
	<option>114</option>
	<option>115</option>
	<option>116</option>
	<option>117</option>

	<option>118</option>
	<option>119</option>
	<option>120</option>
	<option>121</option>
	<option>122</option>
	<option>123</option>

	<option>124</option>
	<option>125</option>
	<option>126</option>
	<option>127</option>
	<option>128</option>
	<option>129</option>

	<option>130</option>
	<option>131</option>
	<option>132</option>
	<option>133</option>
	<option>134</option>
	<option>135</option>

	<option>136</option>
	<option>137</option>
	<option>138</option>
	<option>139</option>
	<option>140</option>
	<option>141</option>

	<option>142</option>
	<option>143</option>
	<option>144</option>
	<option>145</option>
	<option>146</option>
	<option>147</option>

	<option>148</option>
	<option>149</option>
	<option>150</option>
	<option>151</option>
	<option>152</option>
	<option>153</option>

	<option>154</option>
	<option>155</option>
	<option>156</option>
	<option>157</option>
	<option>158</option>
	<option>159</option>

	<option>160</option>
	<option>161</option>
	<option>162</option>
	<option>163</option>
	<option>164</option>
	<option>165</option>

	<option>166</option>	
	<option>167</option>
	<option>168</option>
	<option>169</option>
	<option>170</option>
	<option>171</option>

	<option>172</option>
	<option>173</option>
	<option>174</option>
	<option>175</option>
	<option>176</option>
	<option>177</option>

	<option>178</option>
	<option>179</option>
	<option>180</option>
	<option>181</option>
	<option>182</option>
	<option>183</option>

	<option>184</option>
	<option>185</option>
	<option>186</option>
	<option>187</option>
	<option>188</option>
	<option>189</option>

	<option>190</option>
	<option>191</option>
	<option>192</option>
	<option>193</option>
	<option>194</option>
	<option>195</option>

	<option>196</option>
	<option>197</option>
	<option>198</option>
	<option>199</option>
	<option>200</option>
	<option>201</option>

	<option>202</option>
	<option>203</option>
	<option>204</option>
	<option>205</option>
	<option>206</option>
	<option>207</option>

	<option>208</option>
	<option>209</option>
	<option>210</option>
	<option>211</option>
	<option>212</option>
	<option>213</option>

	<option>214</option>
	<option>215</option>
	<option>216</option>
	<option>217</option>
	<option>218</option>
	<option>219</option>

	<option>220</option>
	<option>221</option>
	<option>222</option>
	<option>223</option>
	<option>224</option>
	<option>225</option>

	<option>226</option>
	<option>227</option>
	<option>228</option>
	<option>229</option>
	<option>230</option>
	<option>231</option>

	<option>232</option>
	<option>233</option>
	<option>234</option>
	<option>235</option>
	<option>236</option>
	<option>237</option>

	<option>238</option>
	<option>239</option>
	<option>240</option>
	<option>241</option>
	<option>242</option>
	<option>243</option>

	<option>244</option>
	<option>245</option>
	<option>246</option>
	<option>247</option>
	<option>248</option>
	<option>249</option>

	<option>250</option>
	<option>251</option>
	<option>252</option>
	<option>253</option>
	<option>254</option>
	<option>255</option>
  </select>&nbsp;<b><font size=+1 color="000000">.</b></font>&nbsp;<select size="1" name="ip3">
	<option>0</option>
	<option>1</option>
	<option>2</option>
	<option>3</option>

	<option>4</option>
	<option>5</option>
	<option>6</option>
	<option>7</option>
	<option>8</option>
	<option>9</option>

	<option>10</option>
	<option>11</option>
	<option>12</option>
	<option>13</option>
	<option>14</option>
	<option>15</option>

	<option>16</option>
	<option>17</option>
	<option>18</option>
	<option>19</option>
	<option>20</option>
	<option>21</option>

	<option>22</option>
	<option>23</option>
	<option>24</option>
	<option>25</option>
	<option>26</option>
	<option>27</option>

	<option>28</option>
	<option>29</option>
	<option>30</option>
	<option>31</option>
	<option>32</option>
	<option>33</option>

	<option>34</option>
	<option>35</option>
	<option>36</option>
	<option>37</option>
	<option>38</option>
	<option>39</option>

	<option>40</option>
	<option>41</option>
	<option>42</option>
	<option>43</option>
	<option>44</option>
	<option>45</option>

	<option>46</option>
	<option>47</option>
	<option>48</option>
	<option>49</option>
	<option>50</option>
	<option>51</option>

	<option>52</option>
	<option>53</option>
	<option>54</option>
	<option>55</option>
	<option>56</option>
	<option>57</option>

	<option>58</option>
	<option>59</option>
	<option>60</option>
	<option>61</option>
	<option>62</option>
	<option>63</option>

	<option>64</option>
	<option>65</option>
	<option>66</option>
	<option>67</option>
	<option>68</option>
	<option>69</option>

	<option>70</option>
	<option>71</option>
	<option>72</option>
	<option>73</option>
	<option>74</option>
	<option>75</option>

	<option>76</option>
	<option>77</option>
	<option>78</option>
	<option>79</option>
	<option>80</option>
	<option>81</option>

	<option>82</option>
	<option>83</option>
	<option>84</option>
	<option>85</option>
	<option>86</option>
	<option>87</option>

	<option>88</option>
	<option>89</option>
	<option>90</option>
	<option>91</option>
	<option>92</option>
	<option>93</option>

	<option>94</option>
	<option>95</option>
	<option>96</option>
	<option>97</option>
	<option>98</option>
	<option>99</option>

	<option>100</option>
	<option>101</option>
	<option>102</option>
	<option>103</option>
	<option>104</option>
	<option>105</option>

	<option>106</option>
	<option>107</option>
	<option>108</option>
	<option>109</option>
	<option>110</option>
	<option>111</option>

	<option>112</option>
	<option>113</option>
	<option>114</option>
	<option>115</option>
	<option>116</option>
	<option>117</option>

	<option>118</option>
	<option>119</option>
	<option>120</option>
	<option>121</option>
	<option>122</option>
	<option>123</option>

	<option>124</option>
	<option>125</option>
	<option>126</option>
	<option>127</option>
	<option>128</option>
	<option>129</option>

	<option>130</option>
	<option>131</option>
	<option>132</option>
	<option>133</option>
	<option>134</option>
	<option>135</option>

	<option>136</option>
	<option>137</option>
	<option>138</option>
	<option>139</option>
	<option>140</option>
	<option>141</option>

	<option>142</option>
	<option>143</option>
	<option>144</option>
	<option>145</option>
	<option>146</option>
	<option>147</option>

	<option>148</option>
	<option>149</option>
	<option>150</option>
	<option>151</option>
	<option>152</option>
	<option>153</option>

	<option>154</option>
	<option>155</option>
	<option>156</option>
	<option>157</option>
	<option>158</option>
	<option>159</option>

	<option>160</option>
	<option>161</option>
	<option>162</option>
	<option>163</option>
	<option>164</option>
	<option>165</option>

	<option>166</option>	
	<option>167</option>
	<option>168</option>
	<option>169</option>
	<option>170</option>
	<option>171</option>

	<option>172</option>
	<option>173</option>
	<option>174</option>
	<option>175</option>
	<option>176</option>
	<option>177</option>

	<option>178</option>
	<option>179</option>
	<option>180</option>
	<option>181</option>
	<option>182</option>
	<option>183</option>

	<option>184</option>
	<option>185</option>
	<option>186</option>
	<option>187</option>
	<option>188</option>
	<option>189</option>

	<option>190</option>
	<option>191</option>
	<option>192</option>
	<option>193</option>
	<option>194</option>
	<option>195</option>

	<option>196</option>
	<option>197</option>
	<option>198</option>
	<option>199</option>
	<option>200</option>
	<option>201</option>

	<option>202</option>
	<option>203</option>
	<option>204</option>
	<option>205</option>
	<option>206</option>
	<option>207</option>

	<option>208</option>
	<option>209</option>
	<option>210</option>
	<option>211</option>
	<option>212</option>
	<option>213</option>

	<option>214</option>
	<option>215</option>
	<option>216</option>
	<option>217</option>
	<option>218</option>
	<option>219</option>

	<option>220</option>
	<option>221</option>
	<option>222</option>
	<option>223</option>
	<option>224</option>
	<option>225</option>

	<option>226</option>
	<option>227</option>
	<option>228</option>
	<option>229</option>
	<option>230</option>
	<option>231</option>

	<option>232</option>
	<option>233</option>
	<option>234</option>
	<option>235</option>
	<option>236</option>
	<option>237</option>

	<option>238</option>
	<option>239</option>
	<option>240</option>
	<option>241</option>
	<option>242</option>
	<option>243</option>

	<option>244</option>
	<option>245</option>
	<option>246</option>
	<option>247</option>
	<option>248</option>
	<option>249</option>

	<option>250</option>
	<option>251</option>
	<option>252</option>
	<option>253</option>
	<option>254</option>
	<option>255</option>

  </select></font> /
    <select size="1" name="CidrNet">
        <option value="8">8 (1 Class 'A')</option>
        <option value="9">9 (128 Class 'B's)</option>

        <option value="10">10 (64 Class 'B's)</option>
        <option value="11">11 (32 Class 'B's)</option>
        <option value="12">12 (16 Class 'B's)</option>
        <option value="13">13 (8 Class 'B's)</option>
        <option value="14">14 (4 Class 'B's)</option>
        <option value="15">15 (2 Class 'B's)</option>

        <option value="16">16 (1 Class 'B')</option>
        <option value="17">17 (128 Class 'C's)</option>
        <option value="18">18 (64 Class 'C's)</option>
        <option value="19">19 (32 Class 'C's)</option>
        <option value="20">20 (16 Class 'C's)</option>
        <option value="21">21 (8 Class 'C's)</option>

        <option value="22">22 (4 Class 'C's)</option>
        <option value="23">23 (2 Class 'C's)</option>
        <option value="24">24 (1 Class 'C')</option>

        <option value="25">25 (128 Host)</option>
        <option value="26">26 (64 Hosts)</option>
        <option value="27">27 (32 Hosts)</option>
        <option value="28">28 (16 Hosts)</option>
        <option value="29">29 (8 Hosts)</option>
        <option value="30">30 (4 Hosts)</option>
        <option value="31">31 (2 Hosts)</option>
        <option value="32">32 (1 Host)</option>
  </select>
   </TD>
   </tr>
    <tr class="listRow1">
     <TD class="listCell">
        Description: &nbsp; <INPUT name="ipcidr" value=""></TD>
        </tr>
</table>
<table>
<tr>
  <TD align=right><a href="javascript:document.ipadd.submit()">[ADD]</a></TD>
</TR>
</center>
</table>
</FORM>
<?php

  // Use the footer function from layout.php
  footer();

} // end switch
//------------------------------------------------------------------------------------------

function footer()
{
    print "</style>";
    print "</td></tr></table>\n";
    include_once("./include/bottom_footer.php");    
}

function myheader( $title )
{
	print "<font size=+1>NMID phpIP - $title</font><br>\n";
	print "<font size=-2>Network Management Inventory Database (NMID)</font><br>\n";
    print "<hr>";
    ?>
        <style type="text/css">

        .listHeading 		    { font-family: tahoma,arial,helvetica,sans-serif; font-weight: bold; font-size: 12px; border-right: 1px solid #4B93C1; border-bottom: 1px solid #0A293F; padding:3px; }
        .listHeading a:link         { font-weight:bold; color: white; padding-left:4px }
        .listHeading a:active       { font-weight:bold; color: white; padding-left:4px }
        .listHeading a:visited      { font-weight:bold; color: white; padding-left:4px }
        .listHeading a:hover        { font-weight:bold; color: white; padding-left:4px }
        
        .listHeadingRight           { font-weight: bold; font-size: 12px; border-top: 1px solid #D3E9F7; border-left: 1px solid #D3E9F7; border-right: 1px solid #4B93C1; border-bottom: 1px solid #0A293F; text-align:right; padding-right: 4px; }
        .listHeadRow                { font-weight:bold; font-family: tahoma,arial,helvetica,sans-serif; color: #F5F5F6; background-color: #7BA2D4; margin:0px; padding:3px; }
        .listHeadRow a:link         { font-family: tahoma,arial,helvetica,sans-serif; color: #F5F5F6; background-color: #7BA2D4; margin:0px; padding:3px; }
        
        .listHeadRow2               { font-family: tahoma,arial,helvetica,sans-serif; color: #FFF; background-color: #9EB9DC; margin:0px; padding:3px; }
        .listHeadRow2 a:link        { font-family: tahoma,arial,helvetica,sans-serif; color: #FFF; background-color: #9EB9DC; margin:0px; padding:3px; }
        
        .listRow1                   { background-color: #D9E6F7; margin:0px; padding:3px; }
        .listRow1Over               { background-color: #D9E6F7; margin:0px; padding:3px; }
        .listRow1Click              { background-color: #D9E6F7; margin:0px; padding:3px; }
        .listRow2                   { background-color: #FDFDFD; margin:0px; padding:3px; }
        .listRow2Over               { background-color: #CBDBE8; margin:0px; padding:3px; }
        .listRow2Click              { background-color: #A0E09F; margin:0px; padding:3px; }
        .listRow1a                  { background-color: #FC7E7E; margin:0px; padding:3px; }
        .listRow1aOver              { background-color: #CBDBE8; margin:0px; padding:3px; }
        .listRow1aClick             { background-color: #A0E09F; margin:0px; padding:3px; }
        .listRow2a                  { background-color: #FDE4E4; margin:0px; padding:3px; }
        .listRow2aOver              { background-color: #CBDBE8; margin:0px; padding:3px; }
        .listRow2aClick             { background-color: #A0E09F; margin:0px; padding:3px; }
        
        .listCell                  { padding:3px; font-size:11px;  border-right: 1px solid #3382B4;  border-bottom: 1px solid #3382B4;}
        
        .listCellRight             { font-size:11px; border-right: 1px solid #3382B4; border-bottom: 1px solid #3382B4; text-align:right; padding-right: 4px; }
        .listTable                 { padding:0px; border-top: 1px solid #003B61; border-left: 1px solid #003B61; }
        .listTableInner            { padding:0px; border-top: 1px solid #003B61; }
        
        .listCellI                 { padding:3px; font-size:11px; text-align:left; vertical-align:top; height:30px; }
        .listCellI2                { padding:3px; font-size:11px; text-align:left; vertical-align:top; width:100px; height:30px; }
        
        .admin_bar                 { background-color: #369; color: #FFF; font-weight: bold; text-align: right; padding: 2px; font-size: medium; border: 2px solid #000; }
        .owner_bar                 { background-color: #369; color: #FFF; font-weight: bold; text-align: right; padding: 2px; font-size: medium; border: 2px solid #000; }
        
        .admin_bar a               { color: #FFF; }
        .owner_bar a               { color: #FFF; }

        </style
        <SCRIPT LANGUAGE="JavaScript">

        <!-- 	
        // by Nannette Thacker
        // http://www.shiningstar.net
        // This script checks and unchecks boxes on a form
        // Checks and unchecks unlimited number in the group...
        // Pass the Checkbox group name...
        // call buttons as so:
        // <input type=button name="CheckAll"   value="Check All"
            //onClick="checkAll(document.myform.list)">
        // <input type=button name="UnCheckAll" value="Uncheck All"
            //onClick="uncheckAll(document.myform.list)">
        // -->
        
        <!-- Begin
        function checkAll(field)
        {
        for (i = 0; i < field.length; i++)
            field[i].checked = true ;
        }
        
        function uncheckAll(field)
        {
        for (i = 0; i < field.length; i++)
            field[i].checked = false ;
        }
        //  End -->
        </script>    
    <?php
    print "<table width=600><tr><td>\n";
}
?>
