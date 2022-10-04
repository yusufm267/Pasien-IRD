function showSwal(type,message,title)
{
	Swal.fire(
	  title,
	  message,
	  type
	);
}

function showToast(type,message,title,sub_title='')
{
	$(document).Toasts('create', {
		class: 'bg-'+type,
		title: title,
		subtitle: sub_title,
		body: message,
	  });
}

