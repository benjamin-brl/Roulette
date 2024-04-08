<main>
    <?php if ($islog && $estProf) { ?>
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
                        <option id="<?= $classe['Id_Classe'] ?>"><?= $classe['nom'] ?></option>
                    <?php } ?>
                </select>
                <label name="nouv_eleves">Ajoutes des élèves</label>
                <textarea name="nouv_eleves" maxlength="2000" placeholder="Exemple :
BARIAL Benjamin
Sylvain Duriff"></textarea>
                <input type="submit" value="Ajouter">
            </form>
        </section>
    <?php } elseif ($islog) { ?>
        <section>
            <h1>Bienvenue</h1>
            <h3><?= $user['nom'] ?> <?= $user['prenom'] ?></h3>
        </section>
    <?php } else { ?>
        <section>
            <h1>Bienvenue</h1>
            <h3>Connexion</h3>
            <p>Veuillez vous <a href="/?a=connexion">connecter</a> pour commencer :</p>
            <form action="/?a=connexion" method="POST">
                <label for="mail"> Votre mail :</label>
                <input id="mail" name="mail" type="mail" placeholder="test@test.test" />
                <label for="psw"> Votre mote de passe :</label>
                <input id="psw" name="psw" type="password" placeholder="Ex4mple.&" />
                <input type="submit" value="Se connecter" />
            </form>
        </section>
    <?php } ?>
</main>