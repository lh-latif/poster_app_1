function (doc, req) {
  if (doc != null) {
    return JSON.stringify({
      _id: doc._id,
      _rev: doc._rev,
      accept_comment: doc.acceot_comment,
      notify_author: doc.notify_author,
      post_id: doc.post_id,
      user_id: doc.user_id
    });
  } else {
    return null;
  }
}
