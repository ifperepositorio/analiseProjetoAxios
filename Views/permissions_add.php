<div id="msg">

</div>

<section>
    <h1>Adicionar Permissões</h1>
</section>


<section class="content-fluid">
    <form id="formPermissao" method="post" class="form-horizontal" action="<?php echo BASE_URL; ?>Permissao/add_action">
        <div class="box">
            <div class="box-header">
                <h3 class="info-box-text">Novo Grupo de Permissão</h3>
                <div class="box-tools">
                    <input type="submit" class="btn btn-success" value="Salvar">
                </div>
            </div>

            <div class="box-body">
                  <div class="form-group <?php echo (in_array('name', $errorItems))?'is-invalid':''; ?>">
                      <label for="group_name">Nome do Grupo</label>
                      <input type="text" name="name" class="form-control">
                  </div>

                <hr>
                <?php foreach ($permission_items as $item): ?>
                  <div class="form-group">
                      <input type="checkbox" name="items[]" value="<?php echo $item['id'];?>" id="item-<?php echo $item['id'];?>"/>
                      <label for="item-<?php echo $item['id'];?>"><?php echo $item['name'];?></label>
                  </div>
                <?php endforeach;?>

            </div>
        </div>

    </form>
</section>




