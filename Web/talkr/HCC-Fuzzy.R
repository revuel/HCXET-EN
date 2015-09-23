# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# Project: HCXET                                                              #
#                                                                             #
# File: funciones.R                                                           #
# Date: 14/06/2015                                                            #
# Author: Miguel Revuelta Espinosa; revuel@github                             #
#                                                                             #
# Notes: Statistical anf fuzzy processes.                                     #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

# --------------------------------------------------------------------------- #
# Dependencies & library initialitation
# --------------------------------------------------------------------------- #


dep <- c("FuzzyToolkitUoN", "plotrix")
add <- dep[!(dep %in% installed.packages()[,"Package"])]
if(length(add)) install.packages(add, repos='http://cran.us.r-project.org')

library(FuzzyToolkitUoN)
library(plotrix)

# --------------------------------------------------------------------------- #
# Refactor function from FuzzyToolkitUoN
# --------------------------------------------------------------------------- #

plotMF <- function(FIS, varType, varIndex) {
  #Inputs  : FIS (FIS) representing a FIS which will be used, 
  #			varType(String) which can be either "input" or "output" and 
  #			varIndex (integer) representing the variable in the input/output whose 
  #			membership functions will be plotted to a graph.
  #Outputs	: A graphic containing the derived input data in graph format
  
  # Require the library, 'splines' for graphical chart creation.
  require(splines)
  # Set the plot character to nothing so it will not show on the graph.
  pchVal= ""
  # Set the y axis height.
  ylimVal= c(0,1.25)
  # Create a new plot.
  plot.new()
  # The following block corresponds to whether the variable type is 'input'.
  if(varType == "input") {
    # The following block plots all the membership functions of a specified input variable onto a graph
    plot.window(xlim=c(	FIS$inputList[[varIndex]]$inputBounds[1] - 0.8,FIS$inputList[[varIndex]]$inputBounds[length(FIS$inputList[[varIndex]]$inputBounds)]) + 0.5, ylim=ylimVal)
    eje <- c(FIS$inputList[[varIndex]]$inputBounds[1]:FIS$inputList[[varIndex]]$inputBounds[length(FIS$inputList[[varIndex]]$inputBounds)])
    numMFs= length(FIS$inputList[[varIndex]]$membershipFunctionList)
    for(i in 1:numMFs) {
      colorRGB= runif(3,20,160)
      # mfList is a convenience variable in that it saves a lot of extra code to access the same data.
      mfList= FIS$inputList[[varIndex]]$membershipFunctionList[[i]]
      if(mfList$mfType == 'gaussmf' || mfList$mfType == 'gaussbmf') {
        curvePredict= predict(interpSpline(mfList$mfX, mfList$mfVals))
        lines(curvePredict, col=colorRGB, type="o", xlim=c(1,length(FIS$inputList[[varIndex]]$inputBounds)), ylim=c(0,1), ann=FALSE, pch=pchVal)
        text(mfList$mfParams[2],1.2,mfList$mfName)
      } else {
        lines(mfList$mfX, mfList$mfVals, type="o", col=colorRGB, xlim=c(0,length(FIS$inputList[[varIndex]]$inputBounds)), ylim=c(0,1), ann=FALSE, pch=pchVal)
        text(match(TRUE,mfList$mfVals==max(mfList$mfVals)),1.2,mfList$mfName)
      }
    }
    title(paste("Membership functions from input variable '",FIS$inputList[[varIndex]]$inputName,"'", sep=""))
  } else if(varType == "output") {
    # The following block plots all the membership functions of a specified output variable onto a graph
    plot.window(xlim=c(FIS$outputList[[varIndex]]$outputBounds[1] - 0.8,FIS$outputList[[varIndex]]$outputBounds[length(FIS$outputList[[varIndex]]$outputBounds)]) + 0.5, ylim=ylimVal)
    eje <- c(FIS$outputList[[varIndex]]$outputBounds[1]:FIS$outputList[[varIndex]]$outputBounds[length(FIS$outputList[[varIndex]]$outputBounds)])
    numMFs= length(FIS$outputList[[varIndex]]$membershipFunctionList)
    for(i in 1:numMFs) {
      colorRGB= runif(3,20,160)
      # mfList is a convenience variable in that it saves a lot of extra code to access the same data.
      mfList= FIS$outputList[[varIndex]]$membershipFunctionList[[i]]
      if(mfList$mfType == 'gaussmf' || mfList$mfType == 'gaussbmf') {
        curvePredict= predict(interpSpline(mfList$mfX, mfList$mfVals))
        lines(curvePredict, col=colorRGB, type="o", xlim=c(0,length(FIS$outputList[[varIndex]]$outputBounds)), ylim=c(0,1), ann=FALSE, pch=pchVal)
        text(match(TRUE,mfList$mfVals==max(mfList$mfVals))-0.4,1.2,mfList$mfName)
        text(mfList$mfParams[2],1.2,mfList$mfName)
      } else {
        lines(mfList$mfX, mfList$mfVals, type="o", col=colorRGB, xlim=c(0,length(FIS$outputList[[varIndex]]$outputBounds)), ylim=c(0,1), ann=FALSE, pch=pchVal)
        text(match(TRUE,mfList$mfVals==max(mfList$mfVals)),1.2,mfList$mfName)
      }
    }
    title(paste("Membership functions from output variable '",FIS$outputList[[varIndex]]$outputName,"'", sep=""))
  } else {
    stop("Must be either 'input' or 'output'\n")
  }
  # Plot axes, axex title.
  #eje <- c(FIS$outputList[[varIndex]]$outputBounds[1]:FIS$outputList[[varIndex]]$outputBounds[length(FIS$outputList[[varIndex]]$outputBounds)])
  ejey <- seq(0, 1, 0.2)
  axis(1, at = eje, labels = eje)
  axis(2, at=ejey, labels=ejey)
  title(xlab="Range")
  title(ylab="Degree of membership")
  abline(h = 1, col = "gray", lty = 3)
  abline(h = 0)
  #box()
}

# --------------------------------------------------------------------------- #
# MAIN
# --------------------------------------------------------------------------- #

# Capture OS input data
# · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · #

# Arguments
args <- commandArgs(TRUE)

# Saving values into local variable
vector <- c(args[1], args[2], args[3], args[4], args[5], args[6], args[7], 
            args[8], args[9], args[10], args[11], args[12], args[13], args[14], 
            args[15])

# In order to save images in the current user's folder
folder <- args[16]


# Development usage
# vector <- c(2.1000, 1.8333, 1.7667, 1.9000, 2.0333, 1.6667, 2.0667, 1.6333, 
#             2.7333, 1.8667, 1.8000, 2.3000, 1.5667, 2.4000, 1.9667)
# folder <- 21

# Obtain average of each principle
vector <- as.numeric(vector)
vector.avg <- c(mean(c(vector[1],vector[2],vector[3])),
                mean(c(vector[4],vector[5],vector[6])),
                mean(c(vector[7],vector[8],vector[9])),
                mean(c(vector[10],vector[11],vector[12])),
                mean(c(vector[13],vector[14],vector[15])))
vector10 <- vector.avg * 10

# Creating the matrix to introduce in a FIS object
defu.matrix <<- matrix(vector10, nrow=1, ncol=5)

# Change working directory to user's folder
old.path <<- getwd()
new.path <<- old.path
new.path <<- gsub("talkr","",old.path)
new.path <<- paste(new.path, "Users/", folder, sep="")
setwd(new.path)

# For control purpose only
tryCatch( {
  fileConn <- file("output.txt")
  writeLines(vector, fileConn)
},
error = function (cond) {
  
},
finally = {
  close(fileConn)
})

# Statistical plot saving
# · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · #

# Plot of the input values linear function form
tryCatch( {
  png(filename="mf.png", width=500, height=500)
  plot(vector, type="o", col="blue", xlab="# Question", ylab="Means", 
       main="Response mean value",
       xlim=c(1, 15))
  axis(1, at= c(1:15), labels = c(1:15))
  dev.off()
  
},
error = function (cond) {
  
},
finally = {
  #dev.off()
})

# Grouped Histogram of the answer values
tryCatch( {
  h <- hist(as.numeric(vector), breaks = c(1,1.5,2,2.5,3), right = TRUE,
            include.lowest = TRUE)
  png(filename="hg.png", width=500, height=500)
  plot(h, main = "Grouped histogram", xlab="Response intervals", 
       ylab="Frequency", col= topo.colors(4))
  dev.off()
},
error = function (cond) {
  print(paste("Something went wrong ", cond, sep=""))
},
finally = {
  #dev.off()
})

# Radar plot 
tryCatch( {
  
  names <- c("Harmony", "Context", "Display", "Intercession", "Custody")
  datos <- vector.avg
  datos.names <- names

  par(cex.axis=2)

  png(filename="ra.png", width=900, height=500)
  radial.plot(datos, labels=datos.names,rp.type="p",main="Radar", radial.lim=c(1,3),line.col="blue", start=1)
  dev.off()
},
error = function (cond) {
  print(paste("Something went wrong ", cond, sep=""))
},
finally = {
  #dev.off()
})

# Spider plot
# tryCatch( {
#   h <- hist(as.numeric(vector), breaks = c(1,1.5,2,2.5,3), right = TRUE,
#             include.lowest = TRUE)
#   png(filename="hg.png", width=500, height=500)
#   plot(h, main = "Histograma agrupado", xlab="Intervalo de respuesta", 
#        ylab="Frecuencia", col= topo.colors(4))
#   dev.off() 
# },
# error = function (cond) {
#   print(paste("Something went wrong ", cond, sep=""))
# },
# finally = {
#   #dev.off()
# })


# Fuzzy Item Structure set up
# · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · #

# FIS instantiation
hcFIS <<- newFIS("hcFIS")

# Add variables
hcFIS <<- addVar(hcFIS, "input", "Harmony", 10:30)
hcFIS <<- addVar(hcFIS, "input", "Context", 10:30)
hcFIS <<- addVar(hcFIS, "input", "Display", 10:30)
hcFIS <<- addVar(hcFIS, "input", "Intercession", 10:30)
hcFIS <<- addVar(hcFIS, "input", "Custody", 10:30)
hcFIS <<- addVar(hcFIS, "output", "Classification", 1:10)

# Create and add Input Memebership functions (Armonia)
lopsided <<- gaussMF("lopsided", 10:30, c(3.5,10,1))
semi <<- gaussMF("semi", 10:30, c(3.5,20,1))
balanced <<- gaussMF("balanced", 10:30, c(3.5,30,1))

hcFIS <<- addMF(hcFIS, "input", 1, lopsided)
hcFIS <<- addMF(hcFIS, "input", 1, semi)
hcFIS <<- addMF(hcFIS, "input", 1, balanced)

# Create and add Input Memebership functions (Contexto)
unfit <<- gaussMF("unfit", 10:30, c(3.5,10,1))
sometimes <<- gaussMF("sometimes", 10:30, c(3.5,20,1))
adaptable <<- gaussMF("adaptable", 10:30, c(3.5,30,1))

hcFIS <<- addMF(hcFIS, "input", 2, unfit)
hcFIS <<- addMF(hcFIS, "input", 2, sometimes)
hcFIS <<- addMF(hcFIS, "input", 2, adaptable)

# Create and add Input Memebership functions (DisposiciÃ³n)
hard <<- gaussMF("hard", 10:30, c(3.5,10,1))
standar <<- gaussMF("standar", 10:30, c(3.5,20,1))
easy <<- gaussMF("easy", 10:30, c(3.5,30,1))

hcFIS <<- addMF(hcFIS, "input", 3, hard)
hcFIS <<- addMF(hcFIS, "input", 3, standar)
hcFIS <<- addMF(hcFIS, "input", 3, easy)

# Create and add Input Memebership functions (Intercesion)
losses <<- gaussMF("loss", 10:30, c(3.5,10,1))
aught <<- gaussMF("aught", 10:30, c(3.5,20,1))
saved <<- gaussMF("saved", 10:30, c(3.5,30,1))

hcFIS <<- addMF(hcFIS, "input", 4, losses)
hcFIS <<- addMF(hcFIS, "input", 4, aught)
hcFIS <<- addMF(hcFIS, "input", 4, saved)

# Create and add Input Memebership functions (Custodia)
dangerous <<- gaussMF("dangerous", 10:30, c(3.5,10,1))
regular <<- gaussMF("regular", 10:30, c(3.5,20,1))
respectful <<- gaussMF("respectful", 10:30, c(3.5,30,1))

hcFIS <<- addMF(hcFIS, "input", 5, dangerous)
hcFIS <<- addMF(hcFIS, "input", 5, regular)
hcFIS <<- addMF(hcFIS, "input", 5, respectful)

# Add output Memembership functions
hostile <<- triMF("hostile", 1:10, c(0,1,3,1))
aversive <<- triMF("aversive", 1:10, c(2,3,5,1))
neutral <<- triMF("neutral", 1:10, c(4,5,7,1))
friendly <<- triMF("friendly", 1:10, c(6,7,9,1))
human.centered <<- triMF("centered", 1:10, c(8,10,10,1))

hcFIS <<- addMF(hcFIS, "output", 1, hostile)
hcFIS <<- addMF(hcFIS, "output", 1, aversive)
hcFIS <<- addMF(hcFIS, "output", 1, neutral)
hcFIS <<- addMF(hcFIS, "output", 1, friendly)
hcFIS <<- addMF(hcFIS, "output", 1, human.centered)


# Add rules
hcFIS <<- addRule(hcFIS, c(1,1,1,1,1,1,1,1)) # Hostile
hcFIS <<- addRule(hcFIS, c(1,2,2,2,1,2,1,1)) # Aversive
hcFIS <<- addRule(hcFIS, c(2,2,2,2,2,3,1,1)) # Neutral
hcFIS <<- addRule(hcFIS, c(2,3,3,3,2,4,1,1)) # Friendly
hcFIS <<- addRule(hcFIS, c(3,3,3,3,3,5,1,1)) # Human Centered

# Defuzzyfication
# · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · #
tryCatch( {
  r <- evalFIS(defu.matrix, hcFIS)
},
error = function (cond) {
  print(paste("Something went wrong ", cond, sep=""))
},
finally = {
  #dev.off()
})

# Plot Fuzzy Things
# · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · · #

# Input Variable 1 (Armonia)
png(filename="input1.png", width=500, height=400)
plotMF(hcFIS, "input", 1)
dev.off()

#  Input Variable 2 (Contexto)
png(filename="input2.png", width=500, height=400)
plotMF(hcFIS, "input", 2)
dev.off()

#  Input Variable 3 (Disposicion)
png(filename="input3.png", width=500, height=400)
plotMF(hcFIS, "input", 3)
dev.off()

#  Input Variable 4 (Intercesion)
png(filename="input4.png", width=500, height=400)
plotMF(hcFIS, "input", 4)
dev.off()

#  Input Variable 5 (Custodia)
png(filename="input5.png", width=500, height=400)
plotMF(hcFIS, "input", 5)
dev.off()

# Output Variable 1
png(filename="output.png", width=500, height=400)
plotMF(hcFIS, "output", 1)
dev.off()

# Plot results
png(filename="res.png", width=900, height=500)
plot(0, col="white", 
          main="Axis score", 
          sub=paste("Defuzzyfication value: ", r, sep=""),
          axes=FALSE, ylab="", xlab="", xlim=c(1, 10))
axis(1, at= c(1:10), labels = c(1:10))
abline(h = 0, v = r, col = "gray", lty = 3)
points(r, 0, col="red", pch=13, cex = 15)
dev.off()

# Return to original working directory
setwd(old.path)


