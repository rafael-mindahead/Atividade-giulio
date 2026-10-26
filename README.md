# Atividade PUCPR – Endpoint de busca

## Arquivos
- `database.sql`: cria o banco, a tabela e os cinco clientes de exemplo.
- `buscar.php`: endpoint POST com validação de coluna, PDO e JSON.
- `index.html`: página com Fetch API e tabela criada com `textContent`.

## Rodar localmente
1. Inicie o MySQL/MariaDB.
2. Importe o banco (uma vez): `mysql -u root -p < database.sql`.
3. Configure `$host`, `$banco`, `$usuario` e `$senha` em `buscar.php` conforme o seu MySQL.
4. Garanta que o PHP tenha a extensão `pdo_mysql` habilitada.
5. Na pasta que contém `index.html` e `buscar.php`, execute `php -S localhost:8000`.
6. Abra http://localhost:8000/index.html no navegador (não abra o HTML como `file://`).

## Testes no Console do navegador (F12)
Cole a função a seguir:

```js
async function testar(metodo, campo, valor) {
  const opcoes = { method: metodo };
  if (metodo === 'POST') {
    opcoes.body = new URLSearchParams({ campo, valor });
  }
  const resp = await fetch('buscar.php', opcoes);
  console.log('Status:', resp.status);
  console.log(await resp.json());
}
```

Na página, teste Cidade = Curitiba e Profissão = prof.
No Console, execute separadamente:

```js
testar('POST', 'senha', 'x');
testar('POST', 'nome;DROP TABLE clientes', 'x');
testar('POST', 'nome', "' OR '1'='1");
testar('GET');
```

## Entrega
Monte um único ZIP incluindo `buscar.php`, `index.html` e `prints.pdf`.
No `prints.pdf`, inclua 2 capturas da página para os testes 1 e 2, 4 capturas do Console para os testes 3 a 6, e 1 captura de **Network** mostrando POST, status e Payload. O `prints.pdf` precisa ser feito a partir dos testes reais no seu navegador; por isso não faz parte deste ZIP de código.
