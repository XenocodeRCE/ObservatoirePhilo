<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Survey Philosophie - Professeurs du lycée</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: "Segoe UI", "Arial", sans-serif;
      background: #f8f8fb;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 680px;
      margin: 32px auto 0 auto;
      background: #fff;
      border-radius: 14px;
      box-shadow: 0 2px 12px rgba(50,50,90,0.08);
      padding: 28px 18px 36px 18px;
    }
    h1 {
      font-size: 1.6em;
      margin-bottom: 0.5em;
      color: #22223b;
    }
    .progress {
      margin-bottom: 2em;
      color: #7979a0;
      font-size: 1em;
      text-align: right;
    }
    .question {
      font-size: 1.15em;
      margin-bottom: 1.15em;
      color: #3a3a5b;
      font-weight: 500;
    }
    .domain {
      font-size: 1.04em;
      margin-bottom: 0.3em;
      margin-top: 0.2em;
      color: #5d5fec;
      font-weight: 600;
    }
    .choices {
      margin-bottom: 1.2em;
      margin-top: 0.9em;
    }
    .choice-label {
      display: flex;
      align-items: flex-start;
      margin-bottom: 0.7em;
      cursor: pointer;
      font-size: 1em;
    }
    .choice-label input[type="radio"] {
      margin-right: 0.8em;
      accent-color: #5d5fec;
      margin-top: 2px;
    }
    .custom-choice {
      display: flex;
      align-items: center;
      margin-top: 0.5em;
    }
    .custom-choice input[type="text"] {
      flex: 1;
      padding: 5px 10px;
      font-size: 1em;
      border-radius: 6px;
      border: 1px solid #bdbde5;
      outline: none;
      margin-right: 6px;
      margin-left: 2.2em;
      background: #f3f3ff;
    }
    .comment {
      width: 100%;
      font-size: 0.97em;
      min-height: 38px;
      margin-bottom: 1em;
      border-radius: 7px;
      border: 1px solid #c8c8e5;
      padding: 7px 8px;
      background: #f7f7fa;
      resize: vertical;
    }
    .nav-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 1.5em;
    }
    button {
      background: #5d5fec;
      color: #fff;
      border: none;
      border-radius: 7px;
      padding: 0.65em 1.5em;
      font-size: 1em;
      cursor: pointer;
      transition: background 0.1s;
      font-weight: 500;
    }
    button:disabled {
      background: #bdbde5;
      color: #fff;
      cursor: not-allowed;
    }
    .final {
      text-align: center;
      margin-top: 2em;
    }
    .final textarea {
      width: 98%;
      min-height: 200px;
      margin-top: 1em;
      font-size: 0.96em;
      border-radius: 8px;
      border: 1px solid #bdbde5;
      background: #fcfcfc;
      padding: 10px;
      resize: vertical;
    }
    .download-btn {
      margin-top: 1.3em;
      background: #3948b2;
      color: #fff;
      border: none;
      border-radius: 7px;
      padding: 0.6em 1.3em;
      font-size: 1em;
      cursor: pointer;
      font-weight: 500;
    }
    @media (max-width: 700px) {
      .container { padding: 13px 4vw 24px 4vw; }
      h1 { font-size: 1.13em;}
      .question { font-size: 1em;}
      .domain { font-size: 0.97em;}
    }

    /* Styles pour les graphiques de statistiques */
    .stat-item {
      margin-bottom: 1em;
    }
    .stat-item-label {
      font-size: 0.9em;
      color: #22223b;
      margin-bottom: 0.3em;
    }
    .stat-item-count {
      color: #7979a0;
      font-size: 0.9em;
    }
    .stat-item-bar-container {
      display: flex;
      align-items: center;
      height: 22px;
      background-color: #f0f0f0;
      border-radius: 5px;
      width: 100%;
    }
    .stat-item-bar {
      background-color: #5d5fec;
      height: 100%;
      border-radius: 5px;
      color: white;
      font-size: 0.85em;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding-right: 6px;
      box-sizing: border-box;
      white-space: nowrap;
      overflow: hidden;
      transition: width 0.5s ease-in-out;
    }
    .stat-item-percent-value { /* Pourcentage affiché à l'extérieur pour les petites barres */
      font-size: 0.85em;
      font-weight: 500;
      color: #3a3a5b;
      margin-left: 8px;
    }

    /* Styles pour la modale d'introduction */
    .modal {
      display: block; /* Affichée par défaut */
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5); /* Fond semi-transparent */
      padding-top: 60px; /* Espace pour ne pas coller au haut de la page */
    }
    .modal-content {
      background-color: #fefefe;
      margin: 5% auto;
      padding: 25px 30px;
      border: 1px solid #888;
      width: 80%;
      max-width: 600px;
      border-radius: 10px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
      text-align: left;
    }
    .modal-content h2 {
      margin-top: 0;
      color: #22223b;
    }
    .modal-content p {
      font-size: 0.95em;
      line-height: 1.6;
      color: #3a3a5b;
    }
    .modal-content button {
      display: block;
      margin: 20px auto 0 auto;
    }
  </style>
</head>
<body>
  <div id="introModal" class="modal">
    <div class="modal-content">
      <h2>Bienvenue au Sondage Philosophie !</h2>
      <p>Ce sondage s'adresse aux professeurs de philosophie du lycée. Votre participation est anonyme et précieuse.</p>
      <p><strong>Objectif :</strong> Recueillir des données sur les positions philosophiques majoritaires concernant divers sujets. Ces données, une fois agrégées et anonymisées, ont vocation à être partagées en <strong>open data</strong> à des fins de recherche, d'information et de discussion.</p>
      <p><strong>Durée estimée :</strong> Environ 5 minutes pour répondre à l'ensemble des questions.</p>
      <p>Merci pour votre contribution !</p>
      <button id="startSurveyBtn">Commencer le sondage</button>
    </div>
  </div>

  <div class="container" id="surveyContainer" style="display: none;">
    <h1>Enquête Philosophie : Professeurs du lycée</h1>
    <div class="progress" id="progress"></div>
    <div class="domain" id="domain"></div>
    <div class="question" id="question"></div>
    <div class="choices" id="choices"></div>
    <textarea class="comment" id="comment" placeholder="Commentaire (optionnel)"></textarea>
    <div class="nav-buttons">
      <button id="prevBtn">Précédent</button>
      <button id="nextBtn">Suivant</button>
    </div>
  </div>

  <div id="finalThankYouModal" class="modal" style="display: none;"> {/* Modale de fin, initialement masquée */}
    <div class="modal-content">
      <h2>Merci infiniment pour votre participation !</h2>
      <p>Vos réponses contribuent précieusement à dresser un panorama des perspectives philosophiques au sein du corps enseignant.</p>
      <p><strong>Rappel de l'objectif :</strong> Les données agrégées et anonymisées issues de ce sondage seront partagées en <strong>open data</strong>. Elles pourront ainsi servir de support à la recherche, à l'information, et nourrir des discussions éclairées sur ces sujets fondamentaux.</p>
      <p>N'hésitez pas à partager ce sondage avec vos collègues !</p>
      <button id="closeThankYouModalBtn">Fermer</button>
    </div>
  </div>

  <script>
    // -------------- CHARGEMENT DES QUESTIONS --------------

    let questions = [];
    let current = 0;
    let responses = [];

    const introModal = document.getElementById('introModal');
    const startSurveyBtn = document.getElementById('startSurveyBtn');
    const surveyContainer = document.getElementById('surveyContainer');
    const finalThankYouModal = document.getElementById('finalThankYouModal');
    const closeThankYouModalBtn = document.getElementById('closeThankYouModalBtn');


    startSurveyBtn.onclick = function() {
      introModal.style.display = 'none';
      surveyContainer.style.display = 'block';
      loadQuestions();
    };

    closeThankYouModalBtn.onclick = function() {
      finalThankYouModal.style.display = 'none';
    };

    function loadQuestions() {
      // Charger les questions depuis questions.json
      fetch('questions.json')
        .then(response => response.json())
        .then(data => {
          questions = data;
          responses = Array(questions.length).fill(null);
          renderQuestion();
        })
        .catch(err => {
          document.getElementById('surveyContainer').innerHTML = "<div style='color:red'>Erreur de chargement des questions.</div>";
        });
    }

    // ----------- SURVEY LOGIQUE -----------
    function renderQuestion() {
      if (!questions.length) return; // Attendre le chargement
      if(current >= questions.length) {
        showFinal();
        return;
      }
      const q = questions[current];
      document.getElementById('progress').textContent = `Question ${current+1} / ${questions.length}`;
      document.getElementById('domain').textContent = q.domaine;
      document.getElementById('question').textContent = q.question;

      const choicesDiv = document.getElementById('choices');
      choicesDiv.innerHTML = "";

      // Réponses déjà sélectionnées ?
      let selected = responses[current] ? responses[current].choice : null;
      let customValue = responses[current] && responses[current].custom ? responses[current].custom : "";

      q.choices.forEach((choice, i) => {
        const label = document.createElement('label');
        label.className = 'choice-label';
        const input = document.createElement('input');
        input.type = 'radio';
        input.name = 'choice';
        input.value = choice;
        input.checked = (selected === choice);

        input.onchange = function() {
          if (this.checked) {
            if (choice.startsWith('Aucune de ces réponses')) {
              document.getElementById('customChoiceDiv').style.display = '';
              setTimeout(() => {
                const customTextInput = document.getElementById('customText');
                if (customTextInput) customTextInput.focus();
              }, 50);
              // Ne pas enregistrer/avancer ici, attendre la validation du customText ou NextBtn
            } else {
              responses[current] = {
                choice: choice,
                custom: null,
                comment: document.getElementById('comment').value.trim()
              };
              current++;
              renderQuestion();
            }
          }
        };

        label.appendChild(input);
        label.appendChild(document.createTextNode(choice));
        choicesDiv.appendChild(label);
      });

      // Custom choice
      if(q.allowCustomChoice) {
        const customDiv = document.createElement('div');
        customDiv.className = "custom-choice";
        customDiv.id = "customChoiceDiv";
        customDiv.style.display = (selected && selected.startsWith('Aucune de ces réponses')) ? '' : 'none';

        const input = document.createElement('input');
        input.type = 'text';
        input.placeholder = "Votre réponse personnalisée";
        input.value = customValue||"";
        input.id = "customText";

        // Validation par Entrée ou blur
        input.onkeydown = function(e) {
          if(e.key === "Enter") {
            validerCustom();
          }
        };
        input.onblur = function() {
          if (input.value.trim()) validerCustom();
        };
        function validerCustom() {
          const val = input.value.trim();
          if(!val) {
            alert("Veuillez préciser votre réponse personnalisée.");
            input.focus();
            return;
          }
          responses[current] = {
            choice: q.choices.find(c => c.startsWith('Aucune de ces réponses')),
            custom: val,
            comment: document.getElementById('comment').value.trim()
          };
          current++;
          renderQuestion();
        }

        customDiv.appendChild(input);
        choicesDiv.appendChild(customDiv);
      }

      // Commentaire
      document.getElementById('comment').value = responses[current] && responses[current].comment ? responses[current].comment : '';

      // Boutons
      document.getElementById('prevBtn').disabled = (current === 0);
      document.getElementById('nextBtn').textContent = (current === questions.length-1) ? "Terminer" : "Suivant";
    }

    document.getElementById('prevBtn').onclick = function() {
      if(current > 0) current--;
      renderQuestion();
    };

    document.getElementById('nextBtn').onclick = function() {
      const q_data = questions[current]; // Question actuelle

      // Cas 1: Une réponse est déjà enregistrée pour la question actuelle et elle est complète.
      // (par exemple, on est revenu en arrière, ou un custom a été validé par Entrée/blur)
      // On avance simplement.
      if (responses[current]) {
        const currentResponse = responses[current];
        let isCustomPending = q_data.allowCustomChoice &&
                              currentResponse.choice &&
                              currentResponse.choice.startsWith('Aucune de ces réponses') &&
                              !currentResponse.custom;
        
        if (isCustomPending) {
          // Le choix "Aucune..." est sélectionné, mais le texte custom n'est pas encore dans responses[current].custom
          // Essayons de le récupérer du champ de texte.
          const customTextInput = document.getElementById('customText');
          const customTextValue = customTextInput ? customTextInput.value.trim() : "";
          if (customTextValue) {
            responses[current].custom = customTextValue; // Valider le custom ici
            responses[current].comment = document.getElementById('comment').value.trim();
            // La réponse est maintenant complète.
          } else {
            alert("Veuillez préciser votre réponse personnalisée.");
            if (customTextInput) customTextInput.focus();
            return; // Ne pas avancer
          }
        }
        // Si la réponse est complète (ou n'était pas un custom en attente), on avance.
        current++;
        renderQuestion();
        return;
      }

      // Cas 2: Aucune réponse enregistrée pour 'current' via onchange/validerCustom,
      // ou c'est un "Aucune..." qui n'a pas encore été traité par le bloc ci-dessus.
      // L'utilisateur a coché un radio et clique sur "Suivant".
      let selectedRadioNode = null;
      const radios = document.querySelectorAll('input[name="choice"]');
      for (const r of radios) {
        if (r.checked) {
          selectedRadioNode = r;
          break;
        }
      }

      if (!selectedRadioNode) {
        alert("Veuillez sélectionner une réponse.");
        return;
      }

      const selectedValue = selectedRadioNode.value;
      let customTextFinal = null;

      if (q_data.allowCustomChoice && selectedValue.startsWith('Aucune de ces réponses')) {
        const customTextInput = document.getElementById('customText');
        // Le champ custom doit être visible si "Aucune..." est coché (onchange l'aura affiché).
        customTextFinal = customTextInput ? customTextInput.value.trim() : null;
        if (!customTextFinal) {
          alert("Veuillez préciser votre réponse personnalisée.");
          if (customTextInput) customTextInput.focus();
          return;
        }
      }

      // Enregistrer la réponse et avancer
      responses[current] = {
        choice: selectedValue,
        custom: customTextFinal,
        comment: document.getElementById('comment').value.trim()
      };
      current++;
      renderQuestion();
    };

    // Génère un UID anonyme simple
    function generateUID() {
      return 'uid_' + Math.random().toString(36).substr(2, 9) + Date.now();
    }
    let uid = localStorage.getItem('philo_uid');
    if (!uid) {
      uid = generateUID();
      localStorage.setItem('philo_uid', uid);
    }

    function showFinal() {
      // Enregistrer les réponses anonymement
      fetch('save_result.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({uid: uid, responses: responses})
      })
      .then(res => res.json())
      .then(() => {
        // Après enregistrement, afficher les stats
        showStats();
      })
      .catch(() => {
        document.getElementById('surveyContainer').innerHTML = "<div style='color:red'>Erreur lors de l'enregistrement des réponses.</div>";
      });
    }

    function showStats() {
      // Récupérer les stats globales
      fetch('stats.php')
        .then(res => res.json())
        .then(stats => {
          let html = `<div class="final"><h2>Merci pour votre participation !</h2>
          <p>Vos réponses ont été enregistrées anonymement.<br>Statistiques globales :</p>`;
          stats.forEach((q, idx) => {
            html += `<div style="text-align:left;margin:1.5em 0 2em 0;">
              <div style="font-weight:bold;color:#5d5fec; margin-bottom: 0.8em;">${idx+1}. ${q.question}</div>`;
            q.choices.forEach((c, i) => {
              html += `
              <div class="stat-item">
                <div class="stat-item-label">
                  ${c.text} <span class="stat-item-count">(${c.count} votes)</span>
                </div>
                <div class="stat-item-bar-container">
                  <div class="stat-item-bar" style="width: ${c.percent}%;">
                    ${c.percent >= 15 ? c.percent + '%' : ''}
                  </div>
                  ${c.percent < 15 ? `<span class="stat-item-percent-value">${c.percent}%</span>` : ''}
                </div>
              </div>`;
            });
            html += `</div>`;
          });
          html += `<button class="download-btn" onclick="downloadJson()">Télécharger mes réponses</button>
          <textarea readonly id="finalJson" style="margin-top:1em">${JSON.stringify(responses,null,2)}</textarea>
          </div>`;
          document.getElementById('surveyContainer').innerHTML = html;
          
          // Afficher la modale de remerciement final
          finalThankYouModal.style.display = 'block';
        })
        .catch(() => {
          document.getElementById('surveyContainer').innerHTML = "<div style='color:red'>Erreur lors du chargement des statistiques.</div>";
           // Optionnel : afficher aussi la modale de remerciement même en cas d'erreur de stats, mais avec un message adapté ?
          // Pour l'instant, on ne l'affiche qu'en cas de succès du chargement des stats.
        });
    }

    window.downloadJson = function() {
      const data = document.getElementById('finalJson').value;
      const blob = new Blob([data], {type: "application/json"});
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = "reponses_survey_philo.json";
      document.body.appendChild(a);
      a.click();
      setTimeout(()=>{document.body.removeChild(a)},100);
    }

    // ----------- DÉMARRAGE -----------
  </script>
</body>
</html>
<!-- Note : Lorsqu'une nouvelle réponse personnalisée est ajoutée, elle sera visible pour les prochains utilisateurs lors du chargement de questions.json. -->
