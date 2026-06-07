<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE - Serra Dourada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <style>
        @keyframes pulse-red {
            0%, 100% { background-color: rgba(239, 68, 68, 0.1); }
            50% { background-color: rgba(239, 68, 68, 0.25); }
        }
        .alerta-atraso { animation: pulse-red 2s infinite; }
        .cell-input {
            background: transparent; width: 100%; height: 100%;
            padding: 4px 8px; font-size: 12px; outline: none;
            border: 1px solid transparent; transition: all 0.15s ease;
        }
        .cell-input:focus {
            border-color: #eab308; background-color: rgba(234, 179, 8, 0.05);
        }
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator { cursor: pointer; filter: invert(0.5); }
        .dark input[type="date"]::-webkit-calendar-picker-indicator,
        .dark input[type="time"]::-webkit-calendar-picker-indicator { filter: invert(1); }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-100 font-sans h-screen overflow-hidden transition-colors duration-200">

    <div class="flex h-full w-full">

        <div class="w-64 bg-white dark:bg-gray-950 p-6 flex flex-col justify-between border-r border-gray-200 dark:border-gray-800 shrink-0">
            <div>
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center space-x-2">
                        <span class="text-2xl">🚗</span>
                        <h1 class="text-xl font-bold tracking-wider text-yellow-600 dark:text-yellow-500">SERRA DOURADA</h1>
                    </div>
                </div>
                <div class="flex items-center justify-between bg-gray-200 dark:bg-gray-900 p-2 rounded-lg mb-6">
                    <span class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase px-1">Visualização</span>
                    <button onclick="alternarTema()" id="btn-tema" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-yellow-500 text-xs font-bold px-3 py-1 rounded shadow-sm border border-gray-300 dark:border-gray-700 transition">🌙 Modo Escuro</button>
                </div>
                <nav id="menu-lateral" class="space-y-2">
                    <button onclick="alternarAba('patio')" id="btn-patio" class="w-full flex items-center space-x-3 bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white p-3 rounded-lg font-medium border-l-4 border-yellow-600 dark:border-yellow-500 text-left transition"><span>📊</span> <span>Controle de Pátio</span></button>
                    <button onclick="alternarAba('contrato')" id="btn-contrato" class="w-full flex items-center space-x-3 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-white p-3 rounded-lg transition text-left"><span>📝</span> <span>Novo Contrato</span></button>
                    <button onclick="alternarAba('clientes')" id="btn-clientes" class="w-full flex items-center space-x-3 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-white p-3 rounded-lg transition text-left"><span>👤</span> <span>Clientes</span></button>
                    <button onclick="alternarAba('frota')" id="btn-frota" class="w-full flex items-center space-x-3 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-white p-3 rounded-lg transition text-left"><span>🚘</span> <span>Frota</span></button>
                    <button onclick="alternarAba('gerencia')" id="btn-gerencia" class="w-full flex items-center space-x-3 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-white p-3 rounded-lg transition text-left"><span>⚙️</span> <span>Gerência</span></button>
                </nav>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-800 pt-4 text-xs text-gray-400 dark:text-gray-500">
                <p class="font-semibold text-gray-700 dark:text-white">Yago Lucas</p>
                <p>Nível: Master / Gestão</p>
            </div>
        </div>

        <div id="aba-patio" class="aba-conteudo flex-1 flex flex-col overflow-hidden bg-gray-100 dark:bg-gray-900">
            <header class="bg-white dark:bg-gray-950 p-6 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center shrink-0">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Controle de Pátio Dinâmico</h2>
            </header>
            <div class="flex-1 p-6 overflow-x-auto overflow-y-auto">
                <div class="bg-white dark:bg-gray-950 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm min-w-[2300px]">
                    <table class="w-full text-left border-collapse table-fixed">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 text-[11px] font-bold uppercase border-b border-gray-200 dark:border-gray-800">
                                <th class="p-3 w-40">MODELO</th><th class="p-3 w-28">PLACA</th><th class="p-3 w-28">LOJA</th><th class="p-3 w-40">SITUAÇÃO</th>
                                <th class="p-3 w-40">RETORNOS (DATA)</th><th class="p-3 w-28">HORA</th><th class="p-3 w-28">VALOR</th><th class="p-3 w-28">LOJA</th>
                                <th class="p-3 w-20">DIAS</th><th class="p-3 w-44">VENDEDOR</th><th class="p-3 w-44">ACESSÓRIO</th><th class="p-3 w-56">CLIENTE</th>
                                <th class="p-3 w-40">DATA (RETIRADA)</th><th class="p-3 w-44">DA RESERVA FUTURA</th>
                                <th class="p-3 w-28 text-center bg-gray-100 dark:bg-gray-900 sticky right-0 shadow-lg">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody id="render-tabela-patio" class="text-xs divide-y divide-gray-200 dark:divide-gray-800"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="aba-contrato" class="aba-conteudo flex-1 flex flex-col overflow-y-auto bg-gray-100 dark:bg-gray-900 hidden">
            <header class="bg-white dark:bg-gray-950 p-6 border-b border-gray-200 dark:border-gray-800 shrink-0"><h2 class="text-2xl font-bold text-gray-900 dark:text-white">Abertura de Contrato Integrada</h2></header>
            <main class="p-6 max-w-4xl mx-auto w-full">
                <div class="bg-white dark:bg-gray-950 p-6 rounded-xl border border-gray-200 dark:border-gray-800 space-y-4">
                    <h3 class="text-lg font-bold text-yellow-600 dark:text-yellow-500">Formulário de Entrada Expressa</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Placa Capturada</label>
                            <input type="text" id="contrato-placa" disabled class="w-full bg-gray-200 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-500 dark:text-yellow-500 font-bold font-mono p-2 rounded text-sm cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Nome do Cliente / Locatário</label>
                            <input type="text" id="contrato-cliente" placeholder="Nome Completo" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-sm text-gray-900 dark:text-white outline-none">
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Dias</label>
                            <input type="number" id="contrato-dias" value="1" oninput="recalcularContratoTotal()" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-sm text-gray-900 dark:text-white outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">UF da CNH</label>
                            <select id="contrato-uf" onchange="recalcularContratoTotal()" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-sm text-gray-900 dark:text-white outline-none font-bold">
                                <option value="SP">SP (Sudeste)</option>
                                <option value="RN">RN (Nordeste)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Vendedor</label>
                            <input type="text" id="contrato-vendedor" value="YAGO LUCAS" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-sm text-gray-900 dark:text-white outline-none">
                        </div>
                    </div>
                    <div class="bg-gray-100 dark:bg-gray-900 p-4 rounded-xl space-y-2 border border-gray-200 dark:border-gray-800">
                        <div class="flex justify-between text-xs"><span>Valor Base Diária Categoria:</span><span id="contrato-lbl-base" class="font-bold">R$ 0,00</span></div>
                        <div class="flex justify-between text-xs"><span>Taxa de Higienização:</span><span id="contrato-lbl-higienizacao" class="font-bold">R$ 0,00</span></div>
                        <div class="flex justify-between text-sm font-bold text-yellow-600 dark:text-yellow-500 pt-2 border-t border-gray-200 dark:border-gray-800"><span>TOTAL ESTIMADO:</span><span id="contrato-lbl-total">R$ 0,00</span></div>
                    </div>
                    <div id="contrato-alerta-risco"></div>
                    <button onclick="salvarContratoParaPatio()" class="w-full bg-yellow-600 hover:bg-yellow-500 text-gray-950 font-bold p-3 rounded-lg uppercase text-xs tracking-wider transition">Vincular Contrato ao Pátio</button>
                </div>
            </main>
        </div>

        <div id="aba-clientes" class="aba-conteudo flex-1 flex flex-col bg-gray-100 dark:bg-gray-900 hidden"><header class="bg-white dark:bg-gray-950 p-6 border-b border-gray-200 dark:border-gray-800 shrink-0"><h2 class="text-2xl font-bold text-gray-900 dark:text-white">Clientes</h2></header></div>
        <div id="aba-frota" class="aba-conteudo flex-1 flex flex-col bg-gray-100 dark:bg-gray-900 hidden"><header class="bg-white dark:bg-gray-950 p-6 border-b border-gray-200 dark:border-gray-800 shrink-0"><h2 class="text-2xl font-bold text-gray-900 dark:text-white">Frota Ativa</h2></header></div>

        <div id="aba-gerencia" class="aba-conteudo flex-1 flex flex-col overflow-y-auto bg-gray-100 dark:bg-gray-900 hidden">
            <header class="bg-white dark:bg-gray-950 p-6 border-b border-gray-200 dark:border-gray-800 shrink-0"><h2 class="text-2xl font-bold text-gray-900 dark:text-white">Configurações de Gerência</h2></header>
            <main class="p-6 space-y-8 max-w-5xl w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-gray-950 p-5 rounded-xl border border-gray-200 dark:border-gray-800 space-y-4">
                        <h3 class="text-sm font-bold text-yellow-600 dark:text-yellow-500 uppercase tracking-wider border-b border-gray-200 dark:border-gray-800 pb-2">➕ Cadastrar Situação</h3>
                        <div><label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Nome do Status</label><input type="text" id="ger-situacao-nome" placeholder="Ex: Higienização" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-xs text-gray-900 dark:text-white outline-none"></div>
                        <button onclick="adicionarSituacao()" class="w-full bg-yellow-600 hover:bg-yellow-500 text-gray-950 font-bold p-2 rounded text-xs uppercase tracking-wider transition">Adicionar ao Pátio</button>
                    </div>
                    <div class="md:col-span-2 bg-white dark:bg-gray-950 p-5 rounded-xl border border-gray-200 dark:border-gray-800">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Situações Disponíveis</h3>
                        <div id="ger-lista-situacoes" class="flex flex-wrap gap-2"></div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-950 p-6 rounded-xl border border-gray-200 dark:border-gray-800 space-y-4">
                    <h3 class="text-sm font-bold text-yellow-600 dark:text-yellow-500 uppercase tracking-wider border-b border-gray-200 dark:border-gray-800 pb-2">💵 Módulo Tarifário de Balcão</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div><label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Diária Base (R$)</label><input type="number" id="tar-diaria" value="100.00" oninput="sincronizarTarifas()" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-xs text-gray-900 dark:text-white font-mono outline-none"></div>
                        <div><label class="block text-[10px] font-bold text-gray-400 uppercase mb-1">Taxa Higienização (R$)</label><input type="number" id="tar-higienizacao" value="38.00" oninput="sincronizarTarifas()" class="w-full bg-gray-50 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 p-2 rounded text-xs text-gray-900 dark:text-white font-mono outline-none"></div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        let situacoes = ['Disponível', 'Alugado', 'Em Oficina', 'Venda Lote', 'Atrasado'];
        let tarifas = { diaria: 100.00, higienizacao: 38.00 };
        let frotaPatio = [
            { modelo: 'RENAULT KWID', placa: 'TDEOF10', loja1: 'Aero', situacao: 'Atrasado', retornos: '2026-05-28', hora: '15:32', valor: '1.022,56', loja2: 'Aero', dias: '7', vendedor: 'YAGO LUCAS', acessorio: 'Difusor OK', cliente: 'PLINIO HENRIQUE CHAPARIN', data: '2026-05-21', reservaFutura: '2026-06-15' },
            { modelo: 'FIAT CRONOS', placa: 'QYV4B22', loja1: 'Matriz', situacao: 'Disponível', retornos: '', hora: '', valor: '', loja2: '', dias: '', vendedor: '', acessorio: '', cliente: '', data: '', reservaFutura: '' }
        ];
        let indexCarroSelecionadoParaContrato = null;

        window.onload = function() { renderizarPatio(); renderizarListaGerenciaSituacoes(); };

        function alternarAba(aba) {
            document.querySelectorAll('.aba-conteudo').forEach(div => div.classList.add('hidden'));
            document.querySelectorAll('#menu-lateral button').forEach(btn => btn.className = "w-full flex items-center space-x-3 text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-white p-3 rounded-lg transition text-left");
            document.getElementById(`aba-${aba}`).classList.remove('hidden');
            document.getElementById(`btn-${aba}`).className = "w-full flex items-center space-x-3 bg-gray-200 dark:bg-gray-900 text-gray-900 dark:text-white p-3 rounded-lg font-medium border-l-4 border-yellow-600 dark:border-yellow-500 text-left transition";
        }

        function alternarTema() {
            const html = document.documentElement;
            const btn = document.getElementById('btn-tema');
            if (html.classList.contains('dark')) { html.classList.remove('dark'); btn.innerText = "☀️ Modo Claro"; }
            else { html.classList.add('dark'); btn.innerText = "🌙 Modo Escuro"; }
        }

        function formatarDataBR(dataUS) {
            if(!dataUS) return '-';
            const partes = dataUS.split('-');
            return partes.length !== 3 ? dataUS : `${partes[2]}/${partes[1]}/${partes[0]}`;
        }

        function renderizarPatio() {
            const tbody = document.getElementById('render-tabela-patio');
            tbody.innerHTML = '';
            frotaPatio.forEach((carro, index) => {
                const tr = document.createElement('tr');
                tr.className = carro.situacao === 'Atrasado' ? "alerta-atraso text-red-900 dark:text-red-200" : "hover:bg-gray-50 dark:hover:bg-gray-900/40 transition-colors text-gray-700 dark:text-gray-300";
                let opcoesSituacao = '';
                situacoes.forEach(sit => { opcoesSituacao += `<option value="${sit}" ${carro.situacao === sit ? 'selected' : ''}>${sit}</option>`; });

                tr.innerHTML = `
                    <td class="p-3 font-bold text-gray-900 dark:text-white uppercase">${carro.modelo}</td>
                    <td class="p-3 font-mono font-bold text-yellow-600 dark:text-yellow-500">${carro.placa}</td>
                    <td class="p-1"><input type="text" class="cell-input text-gray-800 dark:text-gray-100" value="${carro.loja1}" oninput="atualizarEstadoCampo(${index}, 'loja1', this.value)"></td>
                    <td class="p-1">
                        <select onchange="atualizarEstadoCampo(${index}, 'situacao', this.value); renderizarPatio();" class="bg-transparent text-xs outline-none w-full h-full p-1 font-semibold text-gray-800 dark:text-gray-100 focus:text-yellow-500"><option value="">[Nenhuma]</option>${opcoesSituacao}</select>
                    </td>
                    <td class="p-1"><input type="date" class="cell-input font-mono text-gray-800 dark:text-gray-100" value="${carro.retornos}" oninput="atualizarEstadoCampo(${index}, 'retornos', this.value)"></td>
                    <td class="p-1"><input type="time" class="cell-input font-mono text-gray-800 dark:text-gray-100" value="${carro.hora}" oninput="atualizarEstadoCampo(${index}, 'hora', this.value)"></td>
                    <td class="p-1"><input type="text" class="cell-input font-mono font-bold" value="${carro.valor}" oninput="atualizarEstadoCampo(${index}, 'valor', this.value)"></td>
                    <td class="p-1"><input type="text" class="cell-input text-gray-800 dark:text-gray-100" value="${carro.loja2}" oninput="atualizarEstadoCampo(${index}, 'loja2', this.value)"></td>
                    <td class="p-1"><input type="text" class="cell-input font-mono text-center" value="${carro.dias}" oninput="atualizarEstadoCampo(${index}, 'dias', this.value)"></td>
                    <td class="p-1"><input type="text" class="cell-input uppercase" value="${carro.vendedor}" oninput="atualizarEstadoCampo(${index}, 'vendedor', this.value)"></td>
                    <td class="p-1"><input type="text" class="cell-input" value="${carro.acessorio}" oninput="atualizarEstadoCampo(${index}, 'acessorio', this.value)"></td>
                    <td class="p-1"><input type="text" class="cell-input uppercase font-medium" value="${carro.cliente}" oninput="atualizarEstadoCampo(${index}, 'cliente', this.value)"></td>
                    <td class="p-1"><input type="date" class="cell-input font-mono text-gray-800 dark:text-gray-100" value="${carro.data}" oninput="atualizarEstadoCampo(${index}, 'data', this.value)"></td>
                    <td class="p-1"><input type="date" class="cell-input font-mono text-gray-800 dark:text-gray-100" value="${carro.reservaFutura}" oninput="atualizarEstadoCampo(${index}, 'reservaFutura', this.value)"></td>
                    <td class="p-3 text-center bg-gray-55 dark:bg-gray-950 sticky right-0 shadow-lg border-l border-gray-200 dark:border-gray-800 space-x-2 whitespace-nowrap">
                        <button onclick="acaoLimparLinha(${index})" title="Limpar">🧹</button>
                        <button onclick="acaoCopiarLinha(${index})" title="Copiar para WhatsApp">📋</button>
                        <button onclick="acaoAbrirContrato(${index})" title="Abrir Contrato">📝</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function atualizarEstadoCampo(index, campo, valor) { frotaPatio[index][campo] = valor; }

        function acaoLimparLinha(index) {
            const m = frotaPatio[index].modelo; const p = frotaPatio[index].placa;
            frotaPatio[index] = { modelo: m, placa: p, loja1: '', situacao: '', retornos: '', hora: '', valor: '', loja2: '', dias: '', vendedor: '', acessorio: '', cliente: '', data: '', reservaFutura: '' };
            renderizarPatio();
        }

        function acaoCopiarLinha(index) {
            const c = frotaPatio[index];
            const msg = `*SERRA DOURADA - STATUS DE VEÍCULO*\n\n• *Veículo:* ${c.modelo} (${c.placa})\n• *Situação:* ${c.situacao || '[Sem Status]'}\n• *Cliente:* ${c.cliente || '-'}\n• *Retirada:* ${formatarDataBR(c.data)}\n• *Retorno:* ${formatarDataBR(c.retornos)} às ${c.hora || '-'}\n• *Valor Recibo:* R$ ${c.valor || '0,00'}`;
            navigator.clipboard.writeText(msg);
            alert(`Copiado com sucesso!`);
        }

        function acaoAbrirContrato(index) {
            indexCarroSelecionadoParaContrato = index;
            document.getElementById('contrato-placa').value = `${frotaPatio[index].modelo} - ${frotaPatio[index].placa}`;
            document.getElementById('contrato-cliente').value = frotaPatio[index].cliente || "";
            document.getElementById('contrato-dias').value = frotaPatio[index].dias || "1";
            alternarAba('contrato'); recalcularContratoTotal();
        }

        function recalcularContratoTotal() {
            const dias = parseInt(document.getElementById('contrato-dias').value) || 0;
            const uf = document.getElementById('contrato-uf').value;
            const sub = dias * tarifas.diaria; const tot = sub + tarifas.higienizacao;
            document.getElementById('contrato-lbl-base').innerText = `R$ ${sub.toFixed(2)}`;
            document.getElementById('contrato-lbl-higienizacao').innerText = `R$ ${tarifas.higienizacao.toFixed(2)}`;
            document.getElementById('contrato-lbl-total').innerText = `R$ ${tot.toFixed(2)}`;
            document.getElementById('contrato-alerta-risco').innerHTML = (uf === 'RN' || dias >= 15) ? `<div class="bg-yellow-100 dark:bg-yellow-950/60 text-yellow-700 dark:text-yellow-400 p-3 rounded-lg text-xs font-semibold border border-yellow-300 dark:border-yellow-900">⚠️ CRITÉRIO DE RISCO GESTÃO: Alerta ativo.</div>` : '';
        }

        function salvarContratoParaPatio() {
            if(indexCarroSelecionadoParaContrato === null) return;
            frotaPatio[indexCarroSelecionadoParaContrato].cliente = document.getElementById('contrato-cliente').value.toUpperCase();
            frotaPatio[indexCarroSelecionadoParaContrato].dias = document.getElementById('contrato-dias').value;
            frotaPatio[indexCarroSelecionadoParaContrato].vendedor = document.getElementById('contrato-vendedor').value.toUpperCase();
            frotaPatio[indexCarroSelecionadoParaContrato].valor = document.getElementById('contrato-lbl-total').innerText.replace("R$ ", "");
            frotaPatio[indexCarroSelecionadoParaContrato].situacao = "Alugado";
            frotaPatio[indexCarroSelecionadoParaContrato].data = new Date().toISOString().split('T')[0];
            renderizarPatio(); alternarAba('patio');
        }

        function renderizarListaGerenciaSituacoes() {
            const container = document.getElementById('ger-lista-situacoes'); container.innerHTML = '';
            situacoes.forEach(sit => {
                const b = document.createElement('span'); b.className = "bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-300 px-3 py-1 rounded text-xs font-bold border border-gray-300 dark:border-gray-700";
                b.innerText = sit; container.appendChild(b);
            });
        }

        function adicionarSituacao() {
            const input = document.getElementById('ger-situacao-nome'); const n = input.value.trim();
            if(!n || situacoes.includes(n)) return; situacoes.push(n); input.value = '';
            renderizarListaGerenciaSituacoes(); renderizarPatio();
        }

        function sincronizarTarifas() {
            tarifas.diaria = parseFloat(document.getElementById('tar-diaria').value) || 0;
            tarifas.higienizacao = parseFloat(document.getElementById('tar-higienizacao').value) || 0;
        }
    </script>
</body>
</html>
