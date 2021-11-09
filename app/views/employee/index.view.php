<?php $this->view("layout/header", $data) ?>

    <form action="<?= ROOT ?>employeesController/create" method="post" class="col-lg-5">
        <h3>Dodaj użytkownika</h3>
        <hr/>
        Imię: <input type="text" name="name" class="form-control"/>
        Nazwisko: <input type="text" name="surname" class="form-control"/>
        Email: <input type="text" name="email" class="form-control"/>
        Telefon: <input type="text" name="phone" class="form-control"/>
        <input type="submit" value="Zapisz" class="btn btn-success"/>
    </form>
    <div class="col-lg-7">
        <h3>Użytkownicy</h3>
        <hr/>
    </div>
    <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">

        <?php foreach ($data["employees"] as $employee) { ?>
            <?php echo $employee["id"]; ?> -
            <?php echo $employee["name"], " ", $employee["surname"]; ?> -
            <?php echo $employee["email"]; ?> -
            <?php echo $employee["phone"]; ?>
            <div class="right">
                <a href="<?= ROOT ?>employeesController/details/<?php echo $employee['id']; ?>" class="btn btn-info">Szczegóły</a>
<!-- <a class="btn btn-danger" onclick='javascript:confirmationDelete($(this));return false;' href=" --><?//= ROOT ?><!--employeesController/delete/--><?php //echo $employee['id']; ?><!--">Usuń</a>-->
                <a class="btn btn-danger" type="button" data-toggle="modal" data-target="#exampleModal" href="">Usuń</a>
            </div>
            <hr/>
        <?php } ?>
    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Czy na pewno chcesz usunąć pracownika?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--                <div class="modal-body">-->
                <!--                    -->
                <!--                </div>-->
                <div class="modal-footer">
                    <a class="btn btn-primary"
                       href="<?= ROOT ?>employeesController/delete/<?php echo $employee['id']; ?>">Tak</a>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Nie</button>
                </div>
            </div>
        </div>
    </div>


<?php $this->view("layout/footer", $data) ?>