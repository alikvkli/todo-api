
## API Kullanımı


```bash
 https://alikvkli.dev/gateway
```

#### Kullanıcı İşlemleri

```http
  POST /api/v1/auth
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | `formData` |

#### Todo'ları Listeleme

```http
  GET /api/v1/todos?user_id={id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `user_id`      | `string` | `query params`|


#### Todo Ekleme

```http
  POST /api/v1/add
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `user_id`      | `string` | `formData`|
| `action`      | `string` | `formData`|

#### Todo Güncelleme

```http
  PATCH /api/v1/update/{id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | `params`|
| `action`      | `string` | `raw data`|
| `status`      | `number` | `raw data`|
  

  #### Todo Silme

```http
  DELETE /api/v1/delete/{id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | `params`|