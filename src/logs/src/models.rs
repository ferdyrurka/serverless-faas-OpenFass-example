#[derive(Queryable)]
pub struct Log {
    pub log_id: i32,
    pub message: String,
    pub created_at: String
}