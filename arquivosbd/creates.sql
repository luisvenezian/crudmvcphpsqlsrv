--Inicialize o seu banco de dados com esssa tabela e a popule um pouco para poder 
--entender melhor a aplicação.


CREATE TABLE [DBO].[tb_usuario]
( id_usuario INT,  nome VARCHAR(80), usuario VARCHAR(18), senha NVARCHAR(36), st_ativo BIT);
