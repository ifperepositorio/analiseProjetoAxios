
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Editar - Colaborador</h3>
    </div>


    <form class="form-horizontal" id="formEdit">

        <input type="text" name="nome" id="nome"       value="<?php echo $info['nome'];?>">
        <input type="text" name="email" id="email"      value="<?php echo $info['email'];?>">
        <input type="text" name="atendente" id="atendente"     value="<?php echo $info['atendente'];?>">
        <input type="text" name="unidade" id="unidade"      value="<?php echo $info['unidade'];?>">
        <input type="text" name="id" id="id" value="<?php echo $info['id'];?>" disabled>



        <select  name="id_permission">
            <option></option>
            <?php foreach ($permissaoList as $item):?>
                <option <?php echo ($item['id']==$info['id_permission']) ? 'selected' : '' ;?>
                    value="<?php echo $item['id']; ?>"><?php echo $item['name'];?></option>
            <?php endforeach;?>
        </select>

        <input type="button" id="btnEdit" value="Atualizar">

    </form>
</div>

<hr>

<script>

        document.getElementById('formEdit').addEventListener('submit', function(e){
               e.preventDefault(); 
        });
        const validador = (id) => {
            let form = document.getElementById(id);
            let length = form.elements.length;
            let collection = [];

            for (let i = 0; i < length-1; i++){
                let key = form.elements[i].name;
                let val = form.elements[i].value;
                collection[key] = val;
            }

            for (key in collection){
                if (collection[key].length === 0){
                    return {
                        status: false,
                        message: key,
                        collection
                    }
                }
            }
            return {
                status: true,
                collection
            }
        }

        let  btnform = document.getElementById("btnEdit");

        btnform.onclick = () => {
            

            let validation = validador('formEdit')

            let data = validation.collection

            let formData = new FormData();

            for (key in data) {
                formData.append(key, data[key])
            }

            for (let pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            if (!validation.status) {

                Swal.fire({
                    icon: 'error',
                    title: 'Informe um(a) ',
                    text: `  ${validation.message}`
                })

                return
            }

            axios.post("<?php echo BASE_URL; ?>colaborador/edit_action/<?php echo $info['id'];?>", formData).then(res => {
                console.table(res.data);

                if (!res.data.success) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro. ',
                        text: `${res.data.message}`
                    })
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Colaborador',
                    text: 'Editado com sucesso'
                })

                setTimeout(function () {
                    document.getElementById("formEdit").reset();
                    window.location = "<?php echo BASE_URL; ?>colaborador";
                }, 3000);

            });
        }

</script>


