import PyPDF2
import re

pdf = PyPDF2.PdfFileReader(open("computer-science-computer-science-scs2.pdf", "rb"))
results = []
for page in pdf.pages:
    text = page.extractText().replace(" ","").split("\n")
    for line in text:
        courses = re.findall("[A-Z]{2}[0-9]{4}|[A-Z]{2}[0-9]{1}[a-z]{3}", line)
        if courses:
            for course in courses:
                print( course)
