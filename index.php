<?php
if (isset($_GET['group'])) $group = $_GET['group'];
else $group = 0;
if (isset($_GET['groupname'])) $groupname = $_GET['groupname'];
else $groupname = 0;


if (isset($_GET['lng'])) $lng = $_GET['lng'];
else $lng = "";

if ($lng == "en") {
    if ($group > 0) $title = "$groupname group registration ";
    else $title = "Contact form";
    $varlabels = array("For&nbsp;an:", "Adult", "Infant-teenager", "Lastame:", "Infant lastname:", "Firstname:", "Infant firstname:", "Contact parent full name:", "Tel:", "E-mail:", "Address:", "Zip:", "City:", "Birthdate:", "Reason for the request:", "Request origin (spontaneous, physician, shrink,...):", "Request origin (Parents, physician, shrink, school...):", "School level:", "Education type:", "Message:", "Send", "Mutuelle:", "YYYY", "DD");
} else {
    $lng = "fr";
    if ($group > 0) $title = "Inscription au groupe : $groupname";
    else $title = "Formulaire de contact";
    $varlabels = array("Pour&nbsp;:", "Adulte", "Enfant-adolescent", "Nom&nbsp;:", "Nom de l'enfant&nbsp;:", "Prénom&nbsp;:", "Prénom de l'enfant&nbsp;:", "Nom du parent à contacter&nbsp;:", "Téléphone&nbsp;:", "E-mail&nbsp;:", "Adresse&nbsp;:", "Code postal&nbsp;:", "Localité&nbsp;:", "Date de naissance&nbsp;:", "Motif de la demande&nbsp;:", "Origine de la demande (spontanée, médecin, psychologue,...)&nbsp;:", "Origine de la demande (parents, médecin, psychologue, PMS, ...)&nbsp;:", "Année scolaire&nbsp;:", "Type d'enseignement&nbsp;:", "Message&nbsp;:", "Envoyer", "Mutuelle&nbsp:", "AAAA", "JJ");
}
?>

<!DOCTYPE html>
<html lang=<?php echo $lng ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="./contact_form.css">
</head>

<body>
    <main>
        <div class="title">
            <h1><?php echo $title ?></h1>
        </div>

        <form action="./post.php" method="post" id="contact_form">
            <div class="description">
                <em>Attention, les champs précédés d'une étoile <i>(*)</i> sont obligatoires.</em>
            </div>

            <?php if ($group == 0) : //SELECT ADULT/CHILD
            ?>
                <section class="label_input_flex">
                    <label for="forwho">
                        <?php echo $varlabels[0] ?>
                    </label>
                    <div>
                        <select name="forwho" id="forwho" onchange="hideunuse()">
                            <option selected="selected" value="adult"><?php echo $varlabels[1] ?></option>
                            <option value="child"><?php echo $varlabels[2] ?></option>
                        </select>
                    </div>
                </section>
                <hr class="separator">
            <?php endif; ?>


            <section class="name_container">
                <div class="lastname_firstname_container">
                    <div id="n1">
                        <label for="lname">
                            <i>(*)</i><?php echo $varlabels[3] ?>
                        </label>
                        <div>
                            <input type="text" name="lname" id="lname" />
                        </div>
                    </div>

                    <?php if ($group == 0) : ?>
                        <div id="n2">
                            <label for="childname">
                                <i>(*)</i><?php echo $varlabels[4] ?>
                            </label>
                            <div>
                                <input type="text" name="childname" id="childname">
                            </div>
                        </div>
                    <?php endif ?>

                    <div id="n3">
                        <label for="fname">
                            <i>(*)</i><?php echo $varlabels[5] ?>
                        </label>
                        <div>
                            <input type="text" name="fname" id="fname">
                        </div>
                    </div>

                    <?php if ($group == 0) : ?>
                        <div id="n4">
                            <label for="childfname">
                                <i>(*)</i><?php echo $varlabels[6] ?>
                            </label>
                            <div>
                                <input type="text" name="childfname" id="childfname">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($group == 0) : ?>
                    <div id="n5">
                        <label for="cntname">
                            <i>(*)</i><?php echo $varlabels[7] ?>
                        </label>
                        <div>
                            <input type="text" name="cntname" id="cntname">
                        </div>
                    </div>
                <?php endif; ?>
            </section>


            <hr class="separator">


            <section class="phone_email_container">
                <input type="hidden" name="phone_number" id="phone_number">
                <div>
                    <label for="tel">
                        <i>(*)</i><?php echo $varlabels[8] ?>
                    </label>
                    <div class="phone_container">
                        <?php //https://github.com/lipis/flag-icons/tree/main Tous les drapeaux en SVG 
                        ?>

                        <div class="custom_select">
                            <input type="hidden" value="0032" id="prefix_phone_number">
                            <button class="button_custom_select"></button>
                            <ul class="options_custom_select" style="display: none;" tabindex="-1">
                                <li data-value="0032" title="Belgium">
                                    <span class="flag">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-be" viewBox="0 0 512 512">
                                            <g fill-rule="evenodd" stroke-width="1pt">
                                                <path d="M0 0h170.7v512H0z" />
                                                <path fill="#ffd90c" d="M170.7 0h170.6v512H170.7z" />
                                                <path fill="#f31830" d="M341.3 0H512v512H341.3z" />
                                            </g>
                                        </svg>
                                    </span>
                                    (+32)
                                </li>
                                <li data-value="0033" title="France">
                                    <span class="flag">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-fr" viewBox="0 0 512 512">
                                            <path fill="#fff" d="M0 0h512v512H0z" />
                                            <path fill="#000091" d="M0 0h170.7v512H0z" />
                                            <path fill="#e1000f" d="M341.3 0H512v512H341.3z" />
                                        </svg>
                                    </span>
                                    (+33)
                                </li>
                                <li data-value="00352" title="Luxembourg">
                                    <span class="flag">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-lu" viewBox="0 0 512 512">
                                            <path fill="#00a1de" d="M0 256h512v256H0z" />
                                            <path fill="#ed2939" d="M0 0h512v256H0z" />
                                            <path fill="#fff" d="M0 170.7h512v170.6H0z" />
                                        </svg>
                                    </span>
                                    (+352)
                                </li>
                                <li data-value="0049" title="Germany">
                                    <span class="flag">
                                        <svg xmlns="http://www.w3.org/2000/svg" id="flag-icons-de" viewBox="0 0 512 512">
                                            <path fill="#ffce00" d="M0 341.3h512V512H0z" />
                                            <path d="M0 0h512v170.7H0z" />
                                            <path fill="#d00" d="M0 170.7h512v170.6H0z" />
                                        </svg>
                                    </span>
                                    (+49)
                                </li>
                            </ul>
                        </div>

                        <input type="text" name="tel" id="tel">
                    </div>
                </div>

                <div>
                    <label for="email">
                        <i>(*)</i><?php echo $varlabels[9] ?>
                    </label>
                    <div>
                        <input type="text" name="email" id="email">
                    </div>
                </div>
            </section>


            <hr class="separator">


            <section>
                <div class="adress_container">
                    <div>
                        <div>
                            <label for="addr">
                                <i>(*)</i><?php echo $varlabels[10] ?>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="addr" id="addr">
                        </div>
                    </div>
                    <div class="city_postal_code_container">
                        <div>
                            <label for="cpost">
                                <i>(*)</i><?php echo $varlabels[11] ?>
                            </label>
                            <div>
                                <input type="text" name="cpost" id="cpost">
                            </div>
                        </div>
                        <div>
                            <label for="loc">
                                <i>(*)</i><?php echo $varlabels[12] ?>
                            </label>
                            <div>
                                <input type="text" name="loc" id="loc">
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <hr class="separator">


            <section>
                <div class="birthdate_container">
                    <div>
                        <label for="birth">
                            <i>(*)</i><?php echo $varlabels[13] ?>
                        </label>
                    </div>
                    <div class="input">
                        <input type="hidden" id="birthdate" name="birthdate">
                        <input type="number" placeholder=<?php echo $varlabels[22] ?> id="ybirthdate" name="ybirthdate" min="1920" max=<?php echo date("Y") ?>>
                        <input type="number" placeholder="MM" id="mbirthdate" name="mbirthdate" min="1" max="12">
                        <input type="number" placeholder=<?php echo $varlabels[23] ?> id="dbirthdate" name="dbirthdate" min="1" max="31">
                    </div>
                </div>
            </section>


            <hr class="separator">

            <section>
                <div class="mutual_national_number_container">
                    <div class="align_end">
                        <div>
                            <label for="mut">
                                <i>(*)</i><?php echo $varlabels[21] ?>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="mut" id="mut">
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="natnumber">
                                <div>
                                    <i>(*)</i>Numéro national :
                                </div>
                                <div><em>(ou équivalent)</em></div>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="natnumber" id="natnumber">
                        </div>
                    </div>
                </div>
            </section>

            <hr class="separator">

            <?php if ($group == 0) : ?>
                <section>
                    <div>
                        <div>
                            <label for="reason">
                                <i>(*)</i><?php echo $varlabels[14] ?>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="reason" id="reason">
                        </div>
                    </div>

                    <div id="n6">
                        <div>
                            <label for="orig">
                                <i>(*)</i><?php echo $varlabels[15] ?>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="orig" id="orig">
                        </div>
                    </div>

                    <div id="n7">
                        <div>
                            <label for="origchild">
                                <i>(*)</i><?php echo $varlabels[16] ?>
                            </label>
                        </div>
                        <div>
                            <input type="text" name="origchild" id="origchild">
                        </div>
                    </div>

                    <div class="school_year_study_container">
                        <div id="n8">
                            <div>
                                <label for="syear">
                                    <i>(*)</i><?php echo $varlabels[17] ?>
                                </label>
                            </div>
                            <div>
                                <input type="text" name="syear" id="syear">
                            </div>
                        </div>
                        <div id="n9">
                            <div>
                                <label for="schtype">
                                    <i>(*)</i><?php echo $varlabels[18] ?>
                                </label>
                            </div>
                            <div>
                                <input type="text" id="schtype" name="schtype">
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <hr class="separator">

            <section>
                <div>
                    <label for="message">
                        <?php echo $varlabels[19] ?>
                    </label>
                    <div>
                        <textarea name="message"></textarea>
                    </div>
                </div>
            </section>

            <div class="submit_container">
                <input type="submit" value=<?php echo $varlabels[20]?>>
            </div>
        </form>
    </main>
</body>

<script language="javascript" type="text/javascript">
    function hideunuse() {
        var opt_selected = document.getElementById('forwho').options[document.getElementById('forwho').selectedIndex].value;
        if (opt_selected == 'adult') {
            document.getElementById('n1').style.display = "";
            document.getElementById('n3').style.display = "";
            document.getElementById('n6').style.display = "";
            document.getElementById('n2').style.display = "none";
            document.getElementById('n4').style.display = "none";
            document.getElementById('n5').style.display = "none";
            document.getElementById('n7').style.display = "none";
            document.getElementById('n8').style.display = "none";
            document.getElementById('n9').style.display = "none";
        } else {
            document.getElementById('n1').style.display = "none";
            document.getElementById('n3').style.display = "none";
            document.getElementById('n6').style.display = "none";
            document.getElementById('n2').style.display = "";
            document.getElementById('n4').style.display = "";
            document.getElementById('n5').style.display = "";
            document.getElementById('n7').style.display = "";
            document.getElementById('n8').style.display = "";
            document.getElementById('n9').style.display = "";
        }
    }

    const CONTACT_FORM = document.getElementById("contact_form");
    const PHONE_NUMBER = document.getElementById("phone_number");
    const SUFFIX_PHONE_NUMBER = document.getElementById("tel");
    const PREFIX_PHONE_NUMBER = document.getElementById("prefix_phone_number");
    const BIRTHDATE = document.getElementById("birthdate");

    CONTACT_FORM.addEventListener("submit", (e) => {
        e.preventDefault();
        let yearBirthDate = document.getElementById("ybirthdate").value;
        let monthBirthDate = parseInt(document.getElementById("mbirthdate").value);
        let dayBirthDate = parseInt(document.getElementById("dbirthdate").value);

        monthBirthDate = isNaN(monthBirthDate) ? 0 : monthBirthDate;
        dayBirthDate = isNaN(dayBirthDate) ? 0 : dayBirthDate;

        if(yearBirthDate.trim() == "" && monthBirthDate == 0 && dayBirthDate == 0){
            BIRTHDATE.value = "";
        }else{
            BIRTHDATE.value = yearBirthDate + "/" + (monthBirthDate < 10 ? "0" + monthBirthDate.toString() : monthBirthDate.toString()) + "/" + (dayBirthDate < 10 ? "0" + dayBirthDate.toString() : dayBirthDate.toString());
        }
        PHONE_NUMBER.value = SUFFIX_PHONE_NUMBER.value.trim() == "" ? "" : PREFIX_PHONE_NUMBER.value + PHONE_NUMBER.value.trim();
        CONTACT_FORM.submit();
    });

    class CustomSelect {
        constructor(customSelect) {
            this.value = "";
            this.currentSelected = 0;
            this.customSelect = customSelect;
            this.buttonCustomSelect = this.customSelect.querySelector(".button_custom_select");
            this.input = this.customSelect.querySelector("input");
            this.containerOptionsCustomSelect = this.customSelect.querySelector(".options_custom_select");
            this.options = this.customSelect.querySelectorAll(".options_custom_select > li");
            this.initEvent();
            this.getSelectInit();
        }

        initEvent() {
            this.buttonCustomSelect.addEventListener("click", (e) => {
                e.preventDefault();

                if (this.containerOptionsCustomSelect.style.display == "none") {
                    this.containerOptionsCustomSelect.style.display = "block";
                } else {
                    this.containerOptionsCustomSelect.style.display = "none";
                }
            });

            this.options.forEach((option, index) => {
                option.addEventListener("click", () => {
                    this.input.value = option.dataset["value"];
                    this.buttonCustomSelect.innerHTML = option.innerHTML;
                    this.options[this.currentSelected].classList.remove("active");
                    this.currentSelected = index;
                    option.classList.add("active");
                    this.containerOptionsCustomSelect.style.display = "none";
                });
            });
        }

        getSelectInit() {
            this.options.forEach((option, index) => {
                if (option.dataset["value"] == this.input.value) {
                    option.classList.add("active");
                    this.currentSelected = index;
                    this.value = option.dataset["value"];
                    this.buttonCustomSelect.innerHTML = option.innerHTML;
                }
            });
        }
    }
    let custom = new CustomSelect(document.querySelector(".custom_select"));

    hideunuse();
</script>

</html>