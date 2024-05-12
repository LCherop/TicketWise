from flask import Flask
from flask import render_template
from datetime import datetime
from . import app

@app.route("/")
def home():
    return "This is TicketWise. Still under development"

# @app.route("/about/")
# def about():
#     return render_template("about.html")

# @app.route("/contact/")
# def contact():
#     return render_template("contact.html")

# @app.route("/api/data")
# def get_data():
#     return app.send_static_file("data.json")