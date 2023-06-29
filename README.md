
## API Kullanımı


```bash
 https://alikvkli.dev/gateway
```

#### Kullanıcı İşlemleri

```bash
  POST /api/v1/auth
```

| Parametre | Tip     | Açıklama                |
| :-------- | :------- | :------------------------- |
| `username` | `string` | `formData` |

#### Todo'ları Listeleme

```bash
  GET /api/v1/todos?user_id={id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `user_id`      | `string` | `query params`|


#### Todo Ekleme

```bash
  POST /api/v1/add
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `user_id`      | `string` | `formData`|
| `action`      | `string` | `formData`|

#### Todo Güncelleme

```bash
  PATCH /api/v1/update/{id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | `params`|
| `action`      | `string` | `raw data`|
| `status`      | `number` | `raw data`|
  

  #### Todo Silme

```bash
  DELETE /api/v1/delete/{id}
```

| Parametre | Tip     | Açıklama                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | `params`|