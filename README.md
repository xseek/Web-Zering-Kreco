Car Registration System

Description: 
	This system will provide user ability to choose service
	from multiple car registration services. User will be able
	to enter its car details and get registration price for his 
	car in all of the CRS. One user will be able to enter multiple 
	cars and share it with other users. User will be able to 
	leave review and rating of service.
	
	CRS will be able to create its account and provide its services. 
	CRS will be able to create promotion for all users.
	
	News feed with regulation changes. Managed by admin.  
	
	Admin panel for all users and CRS users. 
	Admin will maintain info about car registration procedure. 
	
Technical Aspects: 
	Entities: User, Role, Car, Offers, News, CRS, Sessions, Registration
	
	User (username, password, name, avatar, role, personal_id, created)
	Role (name)
	Car  (brand, model, year, hp, ccm, color, doors, transmision, fuel, category, type)
	Offer (Tehnički pregled, ...)
	News (title, content, created, views, author, comments)
	CRS (name, id_num, address, phone, email, social_links, website, rating)
	Sessions (user, date, ip, ua)
	Registration (car, offer, status, start_date, end_date, last_update_date, messages, attachment)
	
	
	