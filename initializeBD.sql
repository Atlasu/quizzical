--
-- Banco de Dados: `sqlstudy`
--

DROP TABLE IF EXISTS `doador`;
DROP TABLE IF EXISTS `entidade`;
DROP TABLE IF EXISTS `evento`;
DROP TABLE IF EXISTS `presenca`;
DROP TABLE IF EXISTS `eventocred`;
DROP TABLE IF EXISTS `quizz`;
DROP TABLE IF EXISTS `questao`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `DOADOR`
--

CREATE
  TABLE IF NOT EXISTS `doador`
  (
    ID		            INTEGER NOT NULL AUTO_INCREMENT,
    PASSWORD			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,  
    USERNAME			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    TIPOSANGUE          VARCHAR (10) COLLATE utf8_unicode_ci NOT NULL ,
    RHSANGUE			CHAR (10) COLLATE utf8_unicode_ci NOT NULL ,
    PESO       			BOOLEAN NOT NULL ,
    ESTADO      		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    CIDADE      		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    NOME				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    IDFACEBOOK			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    PRIMARY KEY ( ID )
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ENTIDADE`
--

CREATE
  TABLE IF NOT EXISTS `entidade`
  (
    ID     				INTEGER		  NOT NULL AUTO_INCREMENT,  
    PASSWORD			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,  
    EMAIL			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    ESTADO      		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    CIDADE      		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    NOME				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    IDFACEBOOK			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    CNPJ				VARCHAR (18) COLLATE utf8_unicode_ci ,
    DESCRICAO			VARCHAR (500)	COLLATE utf8_unicode_ci  ,
    PRIMARY KEY ( ID )
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- --------------------------------------------------------

--
-- Estrutura da tabela `evento`
--

CREATE
  TABLE IF NOT EXISTS `EVENTO`
  (
    ID     				INTEGER		  NOT NULL AUTO_INCREMENT,  
    NOME			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    CIDADE      		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    ESTADO      		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    RUA				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    BAIRRO			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    NUMERO				INTEGER		  NOT NULL ,
    COMPLEMENTO			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    DESCRICAO			VARCHAR (500)	COLLATE utf8_unicode_ci  ,
    LINKFACEBOOK		VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    DATAINICIO          DATE  NOT NULL ,
    DATAFIM          DATE  NOT NULL ,
    HORAINICIO          TIME  NOT NULL ,
    HORAFIM          TIME  NOT NULL ,
    PRIMARY KEY ( ID )
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Estrutura da tabela `PRESENCA`
--

CREATE
  TABLE IF NOT EXISTS `presenca`
  (
    ID     				INTEGER		  NOT NULL AUTO_INCREMENT,  
    IDEVENTO				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    IDDOADOR     			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    PRIMARY KEY ( ID )
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `presenca` ADD CONSTRAINT `fk_evento_id` FOREIGN KEY ( `IDEVENTO` ) REFERENCES `evento` ( `ID` ) ;
 
ALTER TABLE `presenca` ADD CONSTRAINT `fk_doador_id` FOREIGN KEY ( `IDDOADOR` ) REFERENCES `doador` ( `ID` ) ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `EVENTOCREDENCIAIS`
--

CREATE
  TABLE IF NOT EXISTS `eventocred`
  (
    ID     				INTEGER		  NOT NULL AUTO_INCREMENT,  
    IDEVENTO				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    IDENTIDADE     			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    PRIMARY KEY ( ID )
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `eventocred` ADD CONSTRAINT `fk_evento_id` FOREIGN KEY ( `IDEVENTO` ) REFERENCES `evento` ( `ID` ) ;
 
ALTER TABLE `eventocred` ADD CONSTRAINT `fk_entidade_id` FOREIGN KEY ( `IDENTIDADE` ) REFERENCES `entidade` ( `ID` ) ;

--
-- Estrutura da tabela `quizz`
--

CREATE
  TABLE IF NOT EXISTS `QUIZZ`
  (
    ID     				INTEGER		  NOT NULL AUTO_INCREMENT,  
    NOME			VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    PRIMARY KEY ( ID )
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Estrutura da tabela `questao`
--

CREATE
  TABLE IF NOT EXISTS `QUESTAO`
  (
    ID     				INTEGER		  NOT NULL AUTO_INCREMENT,  
    IDQUIZZ				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    ENUNCIADO				VARCHAR (500) COLLATE utf8_unicode_ci NOT NULL ,
    ALTA				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    ALTB				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    ALTC				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    ALTD				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    ANSWER				VARCHAR (100) COLLATE utf8_unicode_ci NOT NULL ,
    PRIMARY KEY ( ID )
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `questao` ADD CONSTRAINT `fk_quizz_id` FOREIGN KEY ( `IDQUIZZ` ) REFERENCES `quizz` ( `ID` ) ;

-- --------------------------------------------------------