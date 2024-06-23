import { ToastContainer, toast } from 'react-toastify';

const ToastContent = ( {
	action,
	category,
	eventData,
	heading,
	subheading,
	closeToast,
} ) => {
	return (
		<div
			className="nfd-survey-toast"
			data-survey-action={ action }
			data-survey-category={ category }
			data-survey-data={ eventData }
		>
			<div className="nfd-survey-toast__icon">Icon</div>
			<div className="nfd-survey-toast__content">
				<div className="nfd-survey-toast__content__heading">
					{ heading }
				</div>
				<div className="nfd-survey-subheading">{ subheading }</div>
				<div
					className="nfd-survey-toast__content__buttons"
					onClick={ closeToast }
				>
					<button
						className="nfd-survey-toast__content__buttons__one"
						data-survey-option={ 1 }
					>
						1
					</button>
					<button
						className="nfd-survey-toast__content__buttons__two"
						data-survey-option={ 2 }
					>
						2
					</button>
					<button
						className="nfd-survey-toast__content__buttons__three"
						data-survey-option={ 3 }
					>
						3
					</button>
					<button
						className="nfd-survey-toast__content__buttons__four"
						data-survey-option={ 4 }
					>
						4
					</button>
					<button
						className="nfd-survey-toast__content__buttons__five"
						data-survey-option={ 5 }
					>
						5
					</button>
				</div>
			</div>
		</div>
	);
};

const Toast = () => {
	window.nfdSurvey?.queue?.toast.forEach( ( survey ) => {
		toast(
			<ToastContent
				action={ survey.action }
				category={ survey.category }
				eventData={ JSON.stringify( survey.data ) }
				heading={ survey.heading }
				subheading={ survey.subheading }
			/>,
			{
				position: 'bottom-right',
			}
		);
	} );

	return (
		<>
			<ToastContainer autoClose={ false } />
		</>
	);
};

export default Toast;
