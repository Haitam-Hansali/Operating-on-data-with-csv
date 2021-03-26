<!doctype HTML>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    session_start();
    $file = fopen('elevesYm2.csv', 'r');
    while (!feof($file)) {  
        $csv[] = fgetcsv($file, 1024); 
    }
    fclose($file);
    function swt($m , $n, $csv) {
        for( $i = $m  ;  $i <= $n  ;  $i++ ) {
            for( $j = 0  ;  $j < 2  ;  $j++ ) {
                echo $csv[$i][$j];
                if( $j == 1 && ! (empty($csv[$i])) ) {
                    ?> <br> 
                    <p class="p1">Enoncé:</p>
                    <p class="p2"> Correction :</p>
                    <div class="div1"> </div>
                    <div class="vertical_line"></div>
                    <img src="YM.png" class="image1" /> 
                    
                    <?php
                    if((count($csv) - 1 != $n) ) {
                    ?>
                       <img src="YM.png" class="image2" />
                    <?php } ?> 
                    <table class="style1">
                    <tr>
                        <th>Binaire</th>
                        <th>Décimal</th>
                        <th>Octal</th>
                        <th>Hexadécimal</th>
                    </tr>
                    <tr>
                        <td> <?php echo $bin = intval(decbin(rand(100,400))) ?> </td>      
                        <td> ...</td>  
                        <td> ... </td> 
                        <td> ... </td> 
                    </tr>
                    <tr>
                        <td> ...</td>  
                        <td> <?php echo $dec = rand(200,400) ?> </td>  
                        <td> ... </td> 
                        <td> ... </td>     
                    </tr>
                    <tr>
                        <td> ... </td>   
                        <td> ... </td>     
                        <td> <?php echo $oct = intval(decoct(rand(100,400))) ?> </td>  
                        <td> ... </td>   
                    </tr>
                    <tr> 
                        <td> ... </td> 
                        <td> ... </td> 
                        <td> ... </td>       
                        <td> <?php echo $hex = dechex(rand(0,400)) ?> </td>  
                    </tr>
                </table>       
                <table class="style2">
                    <tr>
                        <th>Binaire</th>
                        <th>Décimal</th>
                        <th>Octal</th>
                        <th>Hexadécimal</th>
                    </tr>
                    <tr>
                        <td> <?php echo $bin ?> </td>  
                        <td> <?php echo $dec1 = intval(bindec($bin)) ?> </td>  
                        <td> <?php echo decoct($dec1) ?> </td>  
                        <td> <?php echo dechex($dec1) ?> </td>     
                    </tr>
                    <tr>
                        <td> <?php echo decbin($dec) ?> </td>  
                        <td> <?php echo $dec ?> </td>  
                        <td> <?php echo decoct($dec) ?> </td>  
                        <td> <?php echo dechex($dec) ?> </td>         
                    </tr>
                    <tr>
                        <td> <?php echo decbin(intval(octdec($oct))) ?> </td>  
                        <td> <?php echo $dec3 = intval(octdec($oct)) ?> </td>  
                        <td> <?php echo $oct ?> </td>  
                        <td> <?php echo dechex($dec3) ?> </td>  
                    </tr>
                    <tr>
                        <td> <?php echo decbin(intval(hexdec($hex))) ?> </td>  
                        <td> <?php echo $dec5 = intval(hexdec($hex)) ?> </td>  
                        <td> <?php echo decoct($dec5) ?> </td>  
                        <td> <?php echo $hex ?> </td>  
                    </tr>
                    </table>
                    <div class="div1"> </div> <br> 
                    <?php                        
                } 
            }   
        }
    }
?>
<h2> 
    <?php  
        if (empty($_POST) && ! isset($_SESSION['a'])) {
            $a = 1; 
        }
        else if ( ! empty($_POST) ) {
            $n = array_keys($_POST)[0];
            if (in_array($n, array('Suiv', 'Prec'))) {
                $a = $_SESSION['a'];
                if (strcmp($n, 'Prec') && $a < count($csv) - 3 ) {
                    $a += 2;      
                }
                else if (strcmp($n, 'Suiv') && $a > 1 ) { 
                    $a -= 2; 
                }    
            } 
            else if(in_array($n, array('Suiv2', 'Prec2'))){
                $a = $_SESSION['a'];
                if(strcmp($n,'Suiv2')){
                    $a = 1;
                }
                else if(strcmp($n,'Prec2')){
                    if(count($csv)%2 == 0){
                        $a = count($csv) - 3;
                    }
                    else {
                        $a = count($csv) - 2;
                    }
                }
            }
            else {
                $a = intval($n) * 2 - 1; 
            }    
        } 
        else { 
            $a = $_SESSION['a']; 
        }
        $_SESSION['a'] = $a;
        $b = $a + 1;
        swt($a, $b, $csv);    
    ?> 
    <form class="f" method="post" >   
        <?php 
            for($k = 1; $k <= intval(count($csv)/2) ; $k++) {   
                if($k == intval(count($csv))/2 && count($csv)%2 == 0 ) {
                   break; 
                }
        ?>
            <input type="submit" name="<?php echo $k ?>" value="<?php echo $k ?>" > &nbsp;&nbsp;&nbsp; 
        <?php  
            } 
        ?>  <br>
        <button class="b1" name="Prec2" > <span> &laquo;&laquo; </span></button> 
        <button class="b2" name="Prec" > <span> &laquo; </span></button>  
        <p class="p3"> <?php echo $b/2 ?> </p> 
        <button class="b3" name="Suiv" > <span> &raquo; </span></button>  
        <button class="b4" name="Suiv2" > <span> &raquo;&raquo; </span></button> <br> 
        <button class="button" onclick="window.print();" > <span>Imprimer</span></button>
    </form> 
</h2>
</body>