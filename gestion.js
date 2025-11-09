// CONTENU COMPLET DES MODALS (inputs simples)
        function openModal(type) {
            const modal = document.getElementById('modal');
            const title = document.getElementById('modal-title');
            const body = document.getElementById('modal-body');
            modal.style.display = 'flex';

            if (type === 'salles') {
                title.innerText = 'Gestion des Salles';
                body.innerHTML = `
                    <div class="buttons">
                        <button class="btn btn-add active" onclick="showForm('add-salle')">Ajouter</button>
                        <button class="btn btn-edit" onclick="showForm('edit-salle')">Modifier</button>
                        <button class="btn btn-delete" onclick="showForm('del-salle')">Supprimer</button>
                    </div>
                    <div id="add-salle" class="form active">
                        <div class="input-group"><label>Nom de la salle</label><input placeholder="Ex: INA07"></div>
                        <div class="input-group"><label>Description</label><input placeholder="Ex: Salle de cours"></div>
                        <button class="submit-btn" style="background:#27ae60;">Ajouter la salle</button>
                    </div>
                    <div id="edit-salle" class="form">
                        <div class="input-group"><label>ID de la salle à modifier</label><input placeholder="Ex: INA07"></div>
                        <div class="input-group"><label>Nouveau nom</label><input></div>
                        <div class="input-group"><label>Nouvelle description</label><input></div>
                        <button class="submit-btn" style="background:#e30613;">Modifier</button>
                    </div>
                    <div id="del-salle" class="form">
                        <div class="input-group"><label>ID de la salle à supprimer</label><input placeholder="Ex: INA07"></div>
                        <button class="submit-btn" style="background:#e74c3c;">Supprimer définitivement</button>
                    </div>
                `;
            }

            if (type === 'capteurs') {
                title.innerText = 'Gestion des Capteurs';
                body.innerHTML = `
                    <div class="buttons">
                        <button class="btn btn-add active" onclick="showForm('add-capt')">Ajouter</button>
                        <button class="btn btn-edit" onclick="showForm('edit-capt')">Modifier</button>
                        <button class="btn btn-delete" onclick="showForm('del-capt')">Supprimer</button>
                    </div>
                    <div id="add-capt" class="form active">
                        <div class="input-group"><label>ID Capteur</label><input placeholder="Ex: TEMP-01"></div>
                        <div class="input-group"><label>Type</label><input placeholder="Ex: Température"></div>
                        <button class="submit-btn" style="background:#27ae60;">Ajouter le capteur</button>
                    </div>
                    <div id="edit-capt" class="form">
                        <div class="input-group"><label>ID du capteur</label><input placeholder="Ex: TEMP-01"></div>
                        <div class="input-group"><label>Nouveau type</label><input placeholder="Ex: Humidité"></div>
                        <button class="submit-btn" style="background:#e30613;">Modifier</button>
                    </div>
                    <div id="del-capt" class="form">
                        <div class="input-group"><label>ID à supprimer</label><input placeholder="Ex: TEMP-01"></div>
                        <button class="submit-btn" style="background:#e74c3c;">Supprimer</button>
                    </div>
                `;
            }

            if (type === 'assoc') {
                title.innerText = 'Associer Capteur à Salle';
                body.innerHTML = `
                    <div class="form active">
                        <div class="input-group"><label>ID Capteur</label><input placeholder="Ex: TEMP-01"></div>
                        <div class="input-group"><label>ID Salle</label><input placeholder="Ex: INA07"></div>
                        <button class="submit-btn" style="background:#e30613;">Associer</button>
                    </div>
                `;
            }

            if (type === 'seuils') {
                title.innerText = 'Seuils personnalisés';
                body.innerHTML = `
                    <div class="form active">
                        <div class="input-group"><label>ID Capteur</label><input placeholder="Ex: TEMP-01"></div>
                        <div class="input-group"><label>Seuil min</label><input type="number" step="0.1" placeholder="18"></div>
                        <div class="input-group"><label>Seuil max</label><input type="number" step="0.1" placeholder="25"></div>
                        <button class="submit-btn" style="background:#27ae60;">Sauvegarder</button>
                    </div>
                `;
            }
        }

        function closeModal() { 
            document.getElementById('modal').style.display = 'none'; 
        }

        function showForm(id) {
            document.querySelectorAll('.form').forEach(f => f.classList.remove('active'));
            document.querySelectorAll('.btn').forEach(b => b.classList.remove('active'));
            document.getElementById(id).classList.add('active');
            event.target.classList.add('active');
        }

        window.onclick = e => { 
            if (e.target === document.getElementById('modal')) closeModal(); 
        }