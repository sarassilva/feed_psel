<?php
    echo '<div class="feed">';
    echo '<h1>Feed - Cliente X</h1>';
    echo '<ul>';

    $xml = simplexml_load_file('feed_psel.xml');

    foreach($xml->item as $produto) {

        //retira aspas
        $title = preg_replace('/"/i', '', $produto->title);
        $availability = preg_replace('/"/i', '', $produto->availability);
        $color = preg_replace('/"/i', '', $produto->color);
        $category = preg_replace('/"/i', '', $produto->product_type);
        $link = preg_replace('/"/i', '', $produto->link);

        //verifica se o produto está em estoque
        if($availability == 'Em estoque' ) {             
            //corrige a extensão das imagens para jpg e retira as aspas dos link
            $image = preg_replace('/"/i', '', str_replace('mp3','jpg', $produto->image_link));

            
            ?>        

        <li> 
            <a href="<?php echo $link ?>">
                <img src="<?php echo $image ?>" alt='<?php echo $title ?>' />
                <div class="title"> <?php echo $category ?> </div>
                <div class="title"> <?php echo $title ?> </div>
                <div class="price"> <?php echo $produto->price ?> </div>
                <div class="availability"><span>Disponibilidade:</span> <?php echo $availability; ?> </div>
                <div class="color">
                    <?php
                    //verifica se tem cor definida ou é null, caso null pega a cor após o - do titulo
                    if($color == "null") {
                    echo  '<span>Cor:</span> ' .substr($title, strpos($title, "- ") + 1);
                    } else {
                        echo '<span>Cor:</span> ' . $color;
                    }
                    ?>
                </div>
            </a>
        </li>

    <?php  
        }
    }

    echo '</ul></div>';
?>     

<style>
    body {
        font-family: sans-serif;
        font-size: 14px;
    }

    .feed {
        padding: 20px;
    }
    ul {
        padding: 0;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 30px;
        margin: 0;
    }
    li {
        list-style: none;        
    }

    a {
        display: flex;
        flex-direction: column;
        gap: 5px;
        text-decoration:none;
        color: #222;
        padding:20px;
        transition: all linear .2s;
        border: 1px solid #f0f0f0;
    }

    a:hover {
        background: #f0f0f0;
        transition: all linear .2s;
    }

    span {
        font-weight: bold;
    }
</style>
