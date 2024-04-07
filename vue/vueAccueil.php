<main>
    <section>
        <form method="post" action="">
            <label for="reset_n">Reset les notes</label>
            <input name="reset_n" id="reset_n" type="checkbox">
            <label for="reset_p">Reset les passages</label>
            <input name="reset_p" id="reset_p" type="checkbox">
            <input type="submit" value="Reset">
        </form>
    </section>
    <section>
        <form method="post" action="">
            <label for="nom_nouv_c">Nom de la classe</label>
            <input name="nom_nouv_c" id="nom_nouv_c">
            <input type="submit" value="Ajouter">
        </form>
    </section>
    <section>
        <form method="post" action="">
            <label for="nom_c">Choisir une classe</label>
            <select id="nom_c" name="nom_c">
                <?php foreach ($classes as $classe) { ?>
                    <option id="<?=$classe['id_c']?>"><?=$classe['nom_c']?></option>
                <?php } ?>
            </select>
            <label name="nouv_eleves">Ajoutes des élèves</label>
            <textarea name="nouv_eleves" maxlength="2000" placeholder="Exemple :
BARIAL Benjamin
Sylvain Duriff"></textarea>
            <input type="submit" value="Ajouter">
        </form>
    </section>
</main>