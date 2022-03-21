<script>
    function cadastrarEmail(){
        let email_contato = document.querySelector('#email').value;
        window.open('assinatura.php?email='+email_contato, '_BLANCK');
    }
</script>
<div class="col-lg-4 pt-3 pt-lg-0">
    <div class="pb-3">
        <div class="bg-light py2 px-4 mb-3">
            <h3 class="m-0">Telefones úteis</h3>
            <p>
                <strong>190</strong> - Polícia Mílitar<br/>
                <strong>193</strong> - Corpo de Bombeiros
            </p>
        </div>
        <div class="pb-3">
        <div class="bg-light py2 px-4 mb-3">
            <h3 class="m-0">Previsão do tempo</h3>
            <p>
                Previsão do tempo
            </p>
        </div>
    </div>
    </div>
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Patrocinadores</h3>
        </div>
        <?php
        $materiaCtr = new NoticiasCtr();
        $retornoPatrocinadores = $materiaCtr->Pesquisar("select * from anuncios where status = 'A' and id_locais = '2' order by id_anuncio asc limit 5;");
        if(empty($retornoPatrocinadores) == false){
            foreach($retornoPatrocinadores as $retorno){
                ?>
                
        <div class="mb-3 pb-3">
            <a href=""><img class="img-fluid" src="<?php echo $retorno['local_imagem']; ?>" alt=""></a>
        </div>
                <?php
            }
        }
        ?>
    </div>
    <div class="pb-3">
        <div class="bg-light py-2 px-4 mb-3">
            <h3 class="m-0">Newsletter</h3>
        </div>
        <div class="bg-light text-center p-4 mb-3">
            <p>Cadastre seu email e fique bem informado</p>
            <div class="input-group" style="width: 100%;">
                <input type="text" class="form-control form-control-lg" placeholder="Seu email" name="email" id="email">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="cadastrarEmail();">Assinar</button>
                </div>
            </div>
            <small>Para anúnciar utilize a aba contato</small>
        </div>
    </div>
</div>