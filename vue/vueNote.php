<main>
<?php if (!empty($get_classe)) {
    $eleves = $Eleve->getElevesByClasseID($get_classe);
    if (!empty($get_eleve)) { ?>
        <section>
            <p>Nom :<?= $Eleve->getEleveByID($get_eleve)['nom_e'] ?></p>
            <p>Prénom :<?= $Eleve->getEleveByID($get_eleve)['prenom_e'] ?></p>
            <p>Moyenne : <?= $Note->getMoyenneEleveByID($get_eleve) ?></p>
            <form action="./?a=notes&c=<?=$get_classe?>&e=<?=$get_eleve?>" method="POST">
                <label for="absent">Noter absent :</label>
                <input name="absent" id="absent" type="checkbox">
                <label for="note">Nouvelle note :</label>
                <input name="note" id="note" type="number" maxlength="2" max="20" min="0" placeholder="20 pour <?=$Eleve->getEleveByID($get_eleve)['prenom_e']?>">
                <label for="date_n">Date :</label>
                <input name="date_n" id="date_n" type="date" value="<?=date("Y-m-d")?>">
                <input type="submit" value="Valider" disabled>
            </form>
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Note</th>
                        <th>Date</th>
                        <th>Suprrimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $info_notes = $Note->getNotesEleveByID($get_eleve);
                    foreach ($info_notes as $info_note) { ?>
                        <tr>
                            <td>
                                <?= $info_note['note'] ?>
                            </td>
                            <td data-date="<?= $info_note['date_n'] ?>">
                            </td>
                            <td>
                                <form action="?a=notes&c=<?=$get_classe?>&e=<?=$get_eleve?>" method="post">
                                    <input name="id_n" style="display: none" value="<?=$info_note['id_n']?>">
                                    <input type="submit" value="Supprimer">
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    <?php } else {
        $eleves = $Eleve->getElevesByClasseID($get_classe) ?>
        <section>
            Choisir un élève :
            <ul>
                <?php foreach ($eleves as $eleve) { ?>
                    <li>
                        <a href="?a=notes&c=<?=$get_classe?>&e=<?=$eleve['id_e']?>"><?=$eleve['prenom_e'].' '.$eleve['nom_e']?></a>
                    </li>
                <?php } ?>
            </ul>
        </section>
    <?php } ?>
<?php } else {
    $classes = $Classe->getAllClasses() ?>
<section>
    Choisir une classe :
    <ul>
        <?php foreach ($classes as $classe) { ?>
            <li>
                <a href="?a=notes&c=<?=$classe['id_c']?>"><?=$classe['nom_c']?></a>
            </li>
        <?php } ?>
    </ul>
</section>
<?php } ?>
</main>