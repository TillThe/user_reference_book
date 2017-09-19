INSERT INTO city (
id,
name
)
VALUES (
NULL ,  'Санкт-Петербург'
), (
NULL ,  'Москва'
), (
NULL ,  'Казань'
), (
NULL ,  'Ростов'
), (
NULL ,  'Сочи'
), (
NULL ,  'Ярославль'
), (
NULL ,  'Уфа'
), (
NULL ,  'Пермь'
), (
NULL ,  'Екатеринбург'
), (
NULL ,  'Самара'
);
INSERT INTO education (
id,
name
)
VALUES (
NULL ,  'Среднее'
), (
NULL ,  'Среднее специальное'
), (
NULL ,  'Бакалавр'
), (
NULL ,  'Магистр'
), (
NULL ,  'Аспирант'
), (
NULL ,  'Высшее неполное'
);
INSERT INTO user (
  name,
  education_id
)
VALUES (
  'Иванов Петр Николаевич',
  1
);
INSERT INTO users_city (
  user_id,
  city_id
)
VALUES (
  1,
  1
);
