<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $this->view('head');
?>


<div class="blank">
    	<h2>Create a New Classroom</h2>
    	<div class="blankpage-main">
            <div class="signup-block">
          <form action="/classroom/newclass" method="post">
                Classroom Name:
		<input type="text" name="name" placeholder="Classroom Name" required="">
                Strength Of Class: 
                <select name="quantity" style="font-size: 0.9em;
                                padding: 10px 20px;
                                width: 100%;
                                color: #686967;
                                outline: none;
                                border: 1px solid #D3D3D3;
                                border-radius: 5px;
                                -ms-border-radius: 5px;
                                -moz-border-radius: 5px;
                                -o-border-radius: 5px;
                                background: #F5F5F5;
                                margin: 0em 0em 1.5em 0em;">
                    <option value="60">60</option>
                    <option value="61">61</option>
                    <option value="62">62</option>
                    <option value="63">63</option>
                    <option value="64">64</option>
                    <option value="65">65</option>
                    <option value="66">66</option>
                    <option value="67">67</option>
                    <option value="68">68</option>
                    <option value="69">69</option>
                    <option value="70">70</option>
                    <option value="71">71</option>
                    <option value="72">72</option>
                    <option value="73">73</option>
                    <option value="74">74</option>
                    <option value="75">75</option>
                    <option value="76">76</option>
                    <option value="77">77</option>
                    <option value="78">78</option>
                    <option value="79">79</option>
                    <option value="80">80</option>
                    <option value="81">81</option>
                    <option value="82">82</option>
                    <option value="83">83</option>
                    <option value="84">84</option>
                    <option value="85">85</option>
                    <option value="86">86</option>
                    <option value="87">87</option>
                    <option value="88">88</option>
                    <option value="89">89</option>
                    <option value="90">90</option>
                    <option value="91">91</option>
                    <option value="92">92</option>
                    <option value="93">93</option>
                    <option value="94">94</option>
                    <option value="95">95</option>
                    <option value="96">96</option>
                    <option value="97">97</option>
                    <option value="98">98</option>
                    <option value="99">99</option>
                    <option value="100">100</option>
                    <option value="101">101</option>
                    <option value="102">102</option>
                    <option value="103">103</option>
                    <option value="104">104</option>
                    <option value="105">105</option>
                    <option value="106">106</option>
                    <option value="107">107</option>
                    <option value="108">108</option>
                    <option value="109">109</option>
                    <option value="110">110</option>
                    <option value="111">111</option>
                    <option value="112">112</option>
                    <option value="113">113</option>
                    <option value="114">114</option>
                    <option value="115">115</option>
                    <option value="116">116</option>
                    <option value="117">117</option>
                    <option value="118">118</option>
                    <option value="119">119</option>
                    <option value="120">120</option>
                </select>
                College/Institute/Organisation Name:
                <input type="text" name="cname" placeholder="College/Institute/Organisation Name" required="">
		        
		<input type="submit" name="create" value="Create">														
	</form>
    	</div>
            </div>
    </div>
<?php $this->view('footer'); ?>