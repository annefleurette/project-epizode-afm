
<?php
$head_title = 'Epizode - Créer une nouvelle série';
ob_start();
?>
<section>
        <p>Bonjour <?php echo $userData['pseudo']; ?>, content de vous revoir !</p>
</section>
<nav>
    <ul>
        <li class="seriesTab" data-index="1">Membres</li>
        <li class="seriesTab" data-index="2">Séries</li>
        <li class="seriesTab" data-index="3">Episodes</li>
        <li class="seriesTab" data-index="4">Commentaires</li>
    </ul>
</nav>
<section class="seriesContent" data-tab="1">
<?php
    if($usersData !== NULL)
    {
    ?>
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Abonnements</th>
                    <th>Productions</th>
                    <th>Nombre d'auteurs</th>
                    <th>Nombre de coins</th>
                    <th>Date d'inscription</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($usersData as $userInfo)
                {
                ?>
                <tr>
                    <td><?php echo $userInfo['id']; ?></td>
                    <td><?php echo $userInfo['pseudo']; ?></td>
                    <td><?php echo $userInfo['email']; ?></td>
                    <td><?php echo $userInfo['type']; ?></td>
                    <td><?php echo $userInfo['numberSubscriptions']; ?></td>
                    <td><?php echo $userInfo['numberWritings']; ?> série(s)</td>
                    <td><?php echo $userInfo['numberAuthors']; ?></td>
                    <td><?php echo $userInfo['coinsNumber']; ?></td>
                    <td>
                        <?php
                        $date = new DateTime($userInfo['subscriptionDate']);
                        echo $date->format('d/m/Y');
                        ?>  
                    </td>
                    <?php
                    // Pour ne pas se supprimer soi-même
                    if($userInfo['id'] != $_SESSION['idmember'])
                    {
                    ?>
                        <td class="delete"><a href="index.php?action=deleteMember&idmember=<?php echo $userInfo['id']; ?>">SUPPRIMER</a></td>
                    <?php
                    }else{
                        echo "<td></td>";
                    }
                    ?>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    }else{
    ?>
        <p>Epizode n'a pas encore de membre !</p>
    <?php
    }
    ?>
</section>
<script type="text/javascript" src="./public/js/tabs.js"></script>
<script type="text/javascript" src="./public/js/delete.js"></script>
<script type="text/javascript" src="./public/js/datatable.js"></script>
<?php $body_content = ob_get_clean();
require('./src/View/template.php');
?>