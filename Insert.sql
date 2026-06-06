INSERT INTO DESENVOLVEDORAS (NOME) VALUES ('NINTENDO'), ('SEGA'), ('SONY'), ('MICROSOFT'), ('BANDAI'), ('SQUARE'), ('CAPCOM'), ('FROMSOFTWARE'), ('HAL LABORATORY'), ('SNK');

INSERT INTO PUBLISHERS (NOME) VALUES ('NINTENDO'), ('SEGA'), ('SONY'), ('MICROSOFT'), ('BANDAI'), ('SQUARE'), ('CAPCOM'), ('505 GAMES'), ('ROCKSTAR'), ('SNK');

INSERT INTO PLATAFORMAS (NOME, ID_DESENVOLVEDORA) VALUES 
('NINTENDO ENTERTAINMENT SYSTEM', 1), ('SUPER NINTENDO', 1), ('NINTENDO 64', 1), ('GAMECUBE', 1), ('WII', 1), 
('MASTER SYSTEM', 2), ('MEGA DRIVE', 2), ('SEGA SATURN', 2), ('DREAMCAST', 2), 
('PLAYSTATION', 3), ('PLAYSTATION2', 3), ('PLAYSTATION3', 3), ('PLAYSTATION4', 3), 
('XBOX', 4), ('XBOX360', 4), ('XBOXONE', 4);

INSERT INTO LISTAGENEROS (NOME) VALUES ('PLATAFORMA'), ('LUTA'), ('RPG'), ('ACAO'), ('FPS'), ('ESPORTES'), ('CORRIDA'), ('AVENTURA'), ('VISUAL NOVEL'), ('ESTRATEGIA');

INSERT INTO JOGOS (NOME, ID_DESENVOLVEDORA, LANCAMENTO, ID_PUBLISHER, JOGADORES, DESCRICAO, ID_PLATAFORMA) VALUES 
('SUPER MARIO BROS', 1, 1985, 1, 2, 'Derrote o temível Bowser, salve a Princesa Peach e descubra por que este título definiu gerações! Jogue sozinho ou com um amigo!', 1),
('MEGA MAN X', 7, 1993, 7, 1, 'Evolua o seu arsenal, derrote os temíveis Mavericks e descubra por que este título redefiniu a ação nos videogames!', 2),
('SONIC THE HEDGEHOG', 2, 1991, 2, 1, 'O jogador controla Sonic, cujo objetivo é parar os planos de Robotnik, salvando os animais e recuperar as Esmeraldas.', 7),
('METROID', 1, 1986, 1, 1, 'Metroid é um jogo de ação e aventura de rolagem lateral no qual o jogador controla Samus Aran em ambientes bidimensionais.', 1),
('STREET FIGHTER II: THE WORLD WARRIOR', 7, 1991, 7, 2, ' O jogador enfrenta o seu adversário em combates um-contra-um num ambiente fechado, em séries de melhor de três.', 2), 
('THE KING OF FIGHTERS 2002', 10, 2003, 10, 2, 'O jogador enfrenta o seu adversário em combates um-contra-um num ambiente fechado, usando um time de 3 lutadores.', 9),
('DAYTONA USA', 2, 1995, 2, 4, 'Uma jogabilidade simples, que não priorizava o realismo e sim a diversão, com colisões fantasiosas e cheias de efeitos, tornando o seu aprendizado inicial fácil e de certo modo, viciante.', 8),
('ALEX KIDD IN MIRACLE WORLD', 2, 1986, 2, 1, 'Jogo de plataforma em 2D, semelhante ao Super Mario Bros. da Nintendo.', 6),
('DARK SOULS', 8, 2011, 5, 1, 'O enredo de Dark Souls se passa no reino fictício de Lordran, onde os jogadores assumem o papel de um personagem morto-vivo amaldiçoado que inicia uma peregrinação para descobrir o destino de sua espécie.', 12),
('DARK SOULS', 8, 2011, 5, 1, 'O enredo de Dark Souls se passa no reino fictício de Lordran, onde os jogadores assumem o papel de um personagem morto-vivo amaldiçoado que inicia uma peregrinação para descobrir o destino de sua espécie.', 13);

INSERT INTO GENEROS (ID_JOGO, ID_LISTAGENERO) VALUES (1, 1), (1, 8), (2, 1), (2, 4), (3, 1), (3, 8), (4, 4), (4, 8), (5, 2), (6, 2), (7, 7), (8, 1), (8, 8), (9, 3), (10, 3);

INSERT INTO CLIENTES VALUES 
('68119358040', 'JORGE NOGUEIRA', '1990-07-10', 'RUA DOS SANTOS', 'SAO PAULO', 'SP', '17999999999', 'jorge.nogueira@email.com', '1234'),
('12345678901', 'ANA SOUZA', '1995-03-12', 'RUA DAS FLORES', 'SAO PAULO', 'SP', '11988887777', 'ana.souza@email.com', '1234'),
('23456789012', 'BRUNO ALMEIDA', '1988-07-25', 'AVENIDA BRASIL', 'CAMPINAS', 'SP', '19977776666', 'bruno.almeida@email.com', '1234'),
('34567890123', 'CARLA MENDES', '1992-11-03', 'RUA DAS ACACIAS', 'SOROCABA', 'SP', '15966665555', 'carla.mendes@email.com', '1234'),
('45678901234', 'DIEGO FERREIRA', '1990-01-18', 'RUA CENTRAL', 'RIBEIRAO PRETO', 'SP', '16955554444', 'diego.ferreira@email.com', '1234'),
('56789012345', 'ELISA COSTA', '1997-09-09', 'AVENIDA PAULISTA', 'SAO PAULO', 'SP', '11944443333', 'elisa.costa@email.com', '1234'),
('67890123456', 'FELIPE ROCHA', '1985-05-30', 'RUA NOVA', 'JUNDIAI', 'SP', '11933332222', 'felipe.rocha@email.com', '1234'),
('78901234567', 'GABRIELA LIMA', '1993-12-14', 'RUA DO SOL', 'OSASCO', 'SP', '11922221111', 'gabriela.lima@email.com', '1234'),
('89012345678', 'HENRIQUE MARTINS', '1989-06-21', 'RUA DAS PEDRAS', 'MOGI DAS CRUZES', 'SP', '11911110000', 'henrique.martins@email.com', '1234'),
('90123456789', 'ISABELA PEREIRA', '1996-10-05', 'AVENIDA LITORANEA', 'SANTOS', 'SP', '13999998888', 'isabela.pereira@email.com', '1234');

INSERT INTO EMPRESTIMOS (ID_JOGO, CPF, DATA_EMPRESTIMO, DATA_ENTREGA, DEVOLVIDO) VALUES
(1, '68119358040', '2026-05-01', '2026-05-10', 1),
(2, '12345678901', '2026-05-03', '2026-05-12', 1),
(3, '23456789012', '2026-05-05', '2026-05-15', 0),
(4, '34567890123', '2026-05-06', '2026-05-16', 0),
(5, '45678901234', '2026-05-07', '2026-05-17', 1),
(6, '56789012345', '2026-05-08', '2026-05-18', 0),
(7, '67890123456', '2026-05-09', '2026-05-19', 1),
(8, '78901234567', '2026-05-10', '2026-05-20', 0),
(9, '89012345678', '2026-05-11', '2026-05-21', 0),
(10, '90123456789', '2026-05-12', '2026-05-22', 1);

INSERT INTO NOTICIAS (TITULO, CORPO, AUTOR, CREDITO) VALUES
('O produtor de Pokémon Champions explica o elenco limitado e comenta sobre quando novos Pokémon serão adicionados ao jogo', 
'<p>O produtor de Pokémon Champions, Masaaki Hoshino, falou sobre o que os jogadores podem esperar em relação à adição de Pokémon no jogo.
Desde o lançamento, o elenco de personagens permanece o mesmo. Há algo em torno de 200 criaturas utilizáveis, mas obviamente existem muitos outros Pokémon.
Hoshino falou recentemente com a Famitsu e indicou que devemos receber mais Pokémon neste verão. Junto com isso, a equipe também vai “remover algumas restrições de itens segurados”.
Sobre o motivo de o elenco ter sido limitado no início, Hoshino explicou que a equipe “quis criar um ambiente onde até pessoas que não estão familiarizadas com batalhas Pokémon possam entendê-las”. Ele também disse na mesma entrevista que “dar aos jogadores um pouco mais de tempo para aprender esses Pokémon atuais aos poucos pode ser uma boa ideia”.
Aqui está a tradução da conversa:
<span>Como este é um serviço de longo prazo, foi dito que ajustes de balanceamento serão feitos conforme necessário. Você pode explicar melhor o cronograma e o conteúdo que vocês imaginam?
Logo após o lançamento, estávamos lidando com problemas à medida que os encontrávamos. Em termos de mudança do ambiente, primeiro estamos focando nossa atenção no lançamento da versão para smartphones. Depois disso, em cerca de três meses planejamos adicionar mais Pokémon e remover algumas restrições de itens segurados.
No estado atual, onde há muitas Mega Evoluções de Pokémon, queríamos criar um ambiente onde até pessoas que não estão familiarizadas com batalhas Pokémon pudessem entendê-las facilmente, e acredito que conseguimos isso em grande parte. Algumas pessoas disseram “o número de Pokémon e itens utilizáveis é muito pequeno”, enquanto outras disseram “já há conteúdo suficiente”, então por enquanto planejamos avançar com cautela. No lançamento para smartphones, também queremos priorizar que o jogo seja fácil de aprender para iniciantes.
Os Pokémon e itens adicionados a partir de agora também serão apenas uma seleção limitada, certo?
Sim, isso mesmo. Observando as reações dos jogadores nas redes sociais, parece que muitos dos jogadores mais experientes compartilham o mesmo pensamento que nós: “queremos que muitos novos jogadores entrem”. Claro que, dentro disso, algumas pessoas sentem que atualmente há pouco conteúdo, mas mesmo no estado atual há muitas coisas que novos jogadores podem não entender ou achar difíceis, como habilidades especiais, itens, efeitos de habilidades, etc.
No momento do lançamento da versão para smartphones, esperamos que pessoas que não têm um Nintendo Switch e que nunca jogaram um jogo Pokémon também possam jogar. Com isso em mente, primeiro queremos dar ênfase à facilidade de compreensão e adicionar elementos gradualmente, em um ritmo mais suave.
Atualmente já há mais de 200 Pokémon no jogo, e memorizar todos do zero não é uma tarefa fácil. Não é necessário lembrar de todos, certo?
Isso mesmo. Por exemplo, no shogi existem 8 tipos de peças, mas se houvesse 200 peças seria bem difícil memorizar todas (risos). Portanto, inicialmente, dar aos jogadores mais tempo para aprender esses Pokémon aos poucos pode ser uma boa ideia.
Vocês planejam aumentar o número de Pokémon em ciclos de três meses. Nesse timing, quando também mudam regras e regulamentos, existe a possibilidade de renovar quais Pokémon podem ser usados?
Ainda não está decidido, mas isso pode ser uma possibilidade. Atualmente temos regras permitindo o uso de Mega Evoluções, mas quando mudarmos para um sistema diferente, acredito que também mudaremos os Pokémon para se adequar a esse novo sistema. Por exemplo, pode haver momentos no futuro em que Pokémon Lendários fiquem disponíveis para uso, mas isso não significa necessariamente que, só porque um Pokémon apareceu, ele sempre estará disponível. No momento ainda não está decidido, mas queremos continuar fazendo mudanças adaptativas considerando a opinião de todos.</span>
Hoshino já compartilhou outros comentários sobre o jogo anteriormente. Em uma entrevista, ele comentou sobre os gráficos do jogo. Também falou sobre como os Pokémon escolhidos para o jogo são decididos.</p>',
'Brian', 'https://nintendoeverything.com/pokemon-champions-dev-explains-the-limited-roster-and-comments-on-timing-to-bring-new-pokemon-to-the-game/');

INSERT INTO ADMINS (NOME, SENHA) VALUES ('admin1', '$2y$12$k1QrLznIsqnF3tzJRPu.guAtkQXlQS65zU5psR49Pful9SYrB2SI.');